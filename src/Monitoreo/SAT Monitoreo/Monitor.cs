using System;
using System.Collections.Generic;
using System.Text;
using System.Threading;
using MySql.Data.MySqlClient;

namespace SAT_Monitoreo
{
    class Monitor
    {
        private Thread mon;
        private bool _moni;
        public bool Monitoreando
        {
            get
            {
                return _moni;
            }
        }

        private class alerta
        {
            public string nombre;
            public string idSatelital;
            public uint idAlerta;
            public double uNivelVerde;
            public double uNivelAmarilla;
            public double uNivelRoja;
            public double uLluviaVerde;
            public double uLluviaAmarilla;

            public alerta(string id)
            {
                idSatelital = id;
            }

            public override bool Equals(object obj)
            {
                return (((alerta)obj).idSatelital == this.idSatelital);
            }
        };

        public Monitor()
        {
        }

        public int iniciarMonitoreo()
        {
            Logger.Log("Iniciando monitoreo...");
            mon = new Thread(this.monitorear);
            mon.Start();
            _moni = true;
            return 0;
        }

        public int detenerMonitoreo()
        {
            Logger.Log("Deteniendo monitoreo...");
            mon.Abort();
            _moni = false;
            return 0;
        }

        public int forzarMonitoreo()
        {
            if (mon.ThreadState == ThreadState.WaitSleepJoin)
                mon.Interrupt();
            return 0;
        }

        private Dictionary<string, string[]> getContactos(uint id_estacion)
        {
            Dictionary<string, string[]> dict = new Dictionary<string, string[]>(30);
            string queryLlam, querySms, queryCorreo;
            MySqlConnection con = new MySqlConnection(Properties.Resources.MySqlConn);
            MySqlCommand cmd = new MySqlCommand("", con);
            MySqlDataReader rdr;
            string[] lista = new string[50];
            uint cont = 0;
            if (con.State != System.Data.ConnectionState.Open)
            {
                con.Open();
            }
            queryCorreo = "SELECT direccion " +
                            "FROM sat.correos_alertas " +
                            "WHERE alerta_id = " + id_estacion + "; ";
            cmd.CommandText = queryCorreo;
            rdr = cmd.ExecuteReader();
            while (rdr.Read())
            {
                lista[cont] = rdr.GetString("direccion");
                cont++;
            }
            dict.Add("Correos", lista);
            lista = new string[50];
            cont = 0;
            querySms = "SELECT telefono " +
                       "FROM sat.sms_alertas " +
                       "WHERE alerta_id = " + id_estacion + "; ";
            if (!rdr.IsClosed) rdr.Close();
            cmd.CommandText = querySms;
            rdr = cmd.ExecuteReader();
            while (rdr.Read())
            {
                lista[cont] = rdr.GetString("telefono");
                cont++;
            }
            dict.Add("Sms", lista);
            lista = new string[50];
            cont = 0;
            queryLlam = "SELECT telefono " +
                        "FROM sat.llamadas_alertas " +
                        "WHERE alerta_id = " + id_estacion + "; ";
            if (!rdr.IsClosed) rdr.Close();
            cmd.CommandText = queryLlam;
            rdr = cmd.ExecuteReader();
            while (rdr.Read())
            {
                lista[cont] = rdr.GetString("telefono");
                cont++;
            }
            rdr.Close();
            dict.Add("Llamadas", lista);
            return dict;
        }



        private void monitorear()
        {
            try
            {
                Logger.Log("Monitoreo iniciado.");
                string queryAlertas =
                    "SELECT nombre, id_satelital, alerta_id, umbral_nivel_verde, umbral_nivel_amarilla," +
                    "       umbral_nivel_roja, umbral_lluvia_verde, umbral_lluvia_amarilla " +
                    "FROM" +
                    "(" +
                    "    SELECT nombre, id_satelital, alerta_id" +
                    "    FROM SAT.Estaciones" +
                    "    WHERE activa = 1 AND alerta_id IS NOT NULL" +
                    ") AS e " +
                    "INNER JOIN (" +
                    "    SELECT id, umbral_nivel_verde, umbral_nivel_amarilla, umbral_nivel_roja, " +
                    "    umbral_lluvia_verde, umbral_lluvia_amarilla" +
                    "    FROM SAT.alertas" +
                    ") AS a ON a.id = e.alerta_id;";
                string queryDatos;
                MySqlConnection con;
                MySqlCommand cmd;
                MySqlDataReader rdrMonitoreo;
                System.Collections.ArrayList alertasEstaciones;
                alerta alertaEstacion;
                while (true)
                {
                    con = new MySqlConnection(Properties.Resources.MySqlConn);
                    cmd = new MySqlCommand(queryAlertas, con);
                    if (con.State != System.Data.ConnectionState.Open)
                    {
                        con.Open();
                        Logger.Log("Conexion a BD abierta");
                    }
                    rdrMonitoreo = cmd.ExecuteReader();
                    Logger.Log("Query de estaciones y alertas ejecutado");
                    string ids = "";
                    alertasEstaciones = new System.Collections.ArrayList(50);
                    Logger.Log("Preparando para leer estaciones");
                    while (rdrMonitoreo.Read())
                    {
                        alertaEstacion = new alerta(rdrMonitoreo.GetString("id_satelital"));
                        //alertaEstacion.idSatelital = ;
                        alertaEstacion.nombre = rdrMonitoreo.GetString("nombre");
                        alertaEstacion.idAlerta = rdrMonitoreo.GetUInt32("alerta_id");
                        alertaEstacion.uNivelVerde = rdrMonitoreo.IsDBNull(3) ? -1.0 : rdrMonitoreo.GetDouble("umbral_nivel_verde");
                        alertaEstacion.uNivelAmarilla = rdrMonitoreo.IsDBNull(4) ? -1.0 : rdrMonitoreo.GetDouble("umbral_nivel_amarilla");
                        alertaEstacion.uNivelRoja = rdrMonitoreo.IsDBNull(5) ? -1.0 : rdrMonitoreo.GetDouble("umbral_nivel_roja");
                        alertaEstacion.uLluviaVerde = rdrMonitoreo.IsDBNull(6) ? -1.0 : rdrMonitoreo.GetDouble("umbral_lluvia_verde");
                        alertaEstacion.uLluviaAmarilla = rdrMonitoreo.IsDBNull(7) ? -1.0 : rdrMonitoreo.GetDouble("umbral_lluvia_amarilla");
                        alertasEstaciones.Add(alertaEstacion);
                        ids += "'" + alertaEstacion.idSatelital + "',";
                    }
                    Logger.Log("Datos de estaciones leidos");
                    rdrMonitoreo.Close();
                    queryDatos =
                        "SELECT sta.SATELLITE_ID, dat.*, d.ED_VALUE " +
                        "FROM xc_data.xc_data1 as d " +
                        "INNER JOIN " +
                        "( " +
                        "SELECT STATION_ID, MAX(TIME_TAG) AS TIME_TAG, SENSORNAME " +
                        "FROM xc_data.xc_data1 " +
                        "WHERE SENSORNAME IN ('LLUVIA', 'NIVEL') " +
                        "GROUP BY STATION_ID, SENSORNAME " +
                        ") as dat on dat.TIME_TAG = d.TIME_TAG AND dat.STATION_ID = d.STATION_ID AND d.SENSORNAME = dat.SENSORNAME " +
                        "INNER JOIN " +
                        "( " +
                        "  SELECT STATION_ID, SATELLITE_ID " +
                        "  FROM xc_data.xc_sites " +
                        //"-- \"  WHERE SATELLITE_ID IN ('5042B196', '5045D644', '504484C2', '5042977A', '50469240', '50439580', '5040E41E')" +
                        "  WHERE SATELLITE_ID IN (" + ids.Substring(0, ids.Length - 1) + ") " +
                        ") as sta ON sta.STATION_ID = dat.STATION_ID;";
                    cmd.CommandText = queryDatos;
                    rdrMonitoreo = cmd.ExecuteReader();
                    Logger.Log("Query de datos ejectuado");
                    Logger.Log("Leyendo datos");
                    while (rdrMonitoreo.Read())
                    {
                        int idx = alertasEstaciones.IndexOf(new alerta(rdrMonitoreo.GetString("SATELLITE_ID")));
                        string msg = "";
                        switch (rdrMonitoreo.GetString("SENSORNAME"))
                        {
                            case "NIVEL":
                                if (rdrMonitoreo.GetDouble("ED_VALUE") >= ((alerta)(alertasEstaciones[idx])).uNivelRoja)
                                {
                                    /*System.Windows.Forms.MessageBox.Show(
                                    "ALERTA ROJA!\n" +
                                    "Estación: " + rdrMonitoreo.GetString("STATION_ID") + "\n" +
                                    "Sensor: " + rdrMonitoreo.GetString("SENSORNAME") + "\n" +
                                    "Umbral:" + ((alerta)(alertasEstaciones[idx])).uNivelRoja.ToString() + "\n" +
                                    "Valor: " + rdrMonitoreo.GetDouble("ED_VALUE").ToString() + "\n" +
                                    "Fecha/Hora: " + rdrMonitoreo.GetString("TIME_TAG") + "\n", "ALERTA!!!");*/
                                    msg = "ALERTA ROJA!\n" +
                                    "Estación: " + rdrMonitoreo.GetString("STATION_ID") + "\n" +
                                    "Sensor: " + rdrMonitoreo.GetString("SENSORNAME") + "\n" +
                                    "Umbral:" + ((alerta)(alertasEstaciones[idx])).uNivelRoja.ToString() + "\n" +
                                    "Valor: " + rdrMonitoreo.GetDouble("ED_VALUE").ToString() + "\n" +
                                    "Fecha/Hora: " + rdrMonitoreo.GetString("TIME_TAG") + "\n";
                                }
                                else if (rdrMonitoreo.GetDouble("ED_VALUE") >= ((alerta)(alertasEstaciones[idx])).uNivelAmarilla)
                                {
                                    /*System.Windows.Forms.MessageBox.Show(
                                    "ALERTA AMARILLA!\n" +
                                    "Estación: " + rdrMonitoreo.GetString("STATION_ID") + "\n" +
                                    "Sensor: " + rdrMonitoreo.GetString("SENSORNAME") + "\n" +
                                    "Umbral:" + ((alerta)(alertasEstaciones[idx])).uNivelAmarilla.ToString() + "\n" +
                                    "Valor: " + rdrMonitoreo.GetDouble("ED_VALUE").ToString() + "\n" +
                                    "Fecha/Hora: " + rdrMonitoreo.GetString("TIME_TAG") + "\n", "ALERTA!!!");*/
                                    msg = "ALERTA AMARILLA!\n" +
                                    "Estación: " + rdrMonitoreo.GetString("STATION_ID") + "\n" +
                                    "Sensor: " + rdrMonitoreo.GetString("SENSORNAME") + "\n" +
                                    "Umbral:" + ((alerta)(alertasEstaciones[idx])).uNivelAmarilla.ToString() + "\n" +
                                    "Valor: " + rdrMonitoreo.GetDouble("ED_VALUE").ToString() + "\n" +
                                    "Fecha/Hora: " + rdrMonitoreo.GetString("TIME_TAG") + "\n";
                                }
                                else if (rdrMonitoreo.GetDouble("ED_VALUE") >= ((alerta)(alertasEstaciones[idx])).uNivelVerde)
                                {
                                    /*System.Windows.Forms.MessageBox.Show(
                                    "ALERTA VERDE!\n" +
                                    "Estación: " + rdrMonitoreo.GetString("STATION_ID") + "\n" +
                                    "Sensor: " + rdrMonitoreo.GetString("SENSORNAME") + "\n" +
                                    "Umbral:" + ((alerta)(alertasEstaciones[idx])).uNivelVerde.ToString() + "\n" +
                                    "Valor: " + rdrMonitoreo.GetDouble("ED_VALUE").ToString() + "\n" +
                                    "Fecha/Hora: " + rdrMonitoreo.GetString("TIME_TAG") + "\n", "ALERTA!!!");**/
                                    msg = "ALERTA VERDE!\n" +
                                    "Estación: " + rdrMonitoreo.GetString("STATION_ID") + "\n" +
                                    "Sensor: " + rdrMonitoreo.GetString("SENSORNAME") + "\n" +
                                    "Umbral:" + ((alerta)(alertasEstaciones[idx])).uNivelVerde.ToString() + "\n" +
                                    "Valor: " + rdrMonitoreo.GetDouble("ED_VALUE").ToString() + "\n" +
                                    "Fecha/Hora: " + rdrMonitoreo.GetString("TIME_TAG") + "\n";
                                }
                                if (msg != "")
                                {
                                    Logger.Log(msg);
                                    Dictionary<string, string[]> dict =
                                        getContactos(((alerta)(alertasEstaciones[idx])).idAlerta);
                                    //Correos
                                    foreach (string dir in dict["Correos"])
                                    {
                                        try
                                        {
                                            if (dir != null)
                                            {
                                                Cartero.enviarCorreo(dir, msg);
                                                Logger.Log("Envio de alerta por correo a " + dir);
                                            }
                                        }
                                        catch (Exception ex)
                                        {
                                            Logger.Log("Error: " + ex.Message + "@-> " + dir);
                                        }
                                    }
                                    //Sms
                                    foreach (string tel in dict["Sms"])
                                    {
                                        try
                                        {
                                            if (tel != null)
                                            {
                                                //Mensajero.enviarMensaje(tel, msg);
                                                Logger.Log("Envio de alerta por SMS a " + tel);
                                            }
                                        }
                                        catch (Exception ex)
                                        {
                                            Logger.Log("Error: " + ex.Message + "@-> " + tel);
                                        }
                                    }
                                    //Llamadas
                                    foreach (string tel in dict["Llamadas"])
                                    {
                                        try
                                        {
                                            if (tel != null)
                                            {
                                                //Operadora.Llamar(tel, msg);
                                                Logger.Log("Envio de alerta por Teléfono a " + tel);
                                            }
                                        }
                                        catch (Exception ex)
                                        {
                                            Logger.Log("Error: " + ex.Message + "@-> " + tel);
                                        }
                                    }
                                }
                                break;
                            case "LLUVIA":
                                /* if (rdrMonitoreo.GetDouble("ED_VALUE") >= ((alerta)(alertasEstaciones[idx])).uLluviaVerde)
                                 {
                                     System.Windows.Forms.MessageBox.Show(
                                     "ALERTA ROJA!\n" +
                                     "Estación: " + rdrMonitoreo.GetString("STATION_ID") + "\n" +
                                     "Sensor: " + rdrMonitoreo.GetString("SENSORNAME") + "\n" +
                                     "Umbral:" + ((alerta)(alertasEstaciones[idx])).uNivelRoja.ToString() + "\n" +
                                     "Valor: " + rdrMonitoreo.GetDouble("ED_VALUE").ToString() + "\n" +
                                     "Fecha/Hora: " + rdrMonitoreo.GetString("TIME_TAG") + "\n", "ALERTA!!!");
                                 }
                                 else if (rdrMonitoreo.GetDouble("ED_VALUE") >= ((alerta)(alertasEstaciones[idx])).uLluviaAmarilla)
                                 {
                                     System.Windows.Forms.MessageBox.Show(
                                     "ALERTA AMARILLA!\n" +
                                     "Estación: " + rdrMonitoreo.GetString("STATION_ID") + "\n" +
                                     "Sensor: " + rdrMonitoreo.GetString("SENSORNAME") + "\n" +
                                     "Umbral:" + ((alerta)(alertasEstaciones[idx])).uNivelAmarilla.ToString() + "\n" +
                                     "Valor: " + rdrMonitoreo.GetDouble("ED_VALUE").ToString() + "\n" +
                                     "Fecha/Hora: " + rdrMonitoreo.GetString("TIME_TAG") + "\n", "ALERTA!!!");
                                 }*/
                                break;
                        }
                    }
                    rdrMonitoreo.Close();
                    if (con.State == System.Data.ConnectionState.Open)
                    {
                        con.Close();
                    }
                    Logger.Log("Datos leidos. A dormir " + Parametros.Intervalo.ToString("HH:mm:ss") + " ...");
                    Thread.Sleep(
                        new TimeSpan(
                            Parametros.Intervalo.Hour,
                            Parametros.Intervalo.Minute,
                            Parametros.Intervalo.Second
                        )
                    );
                }

            }
            catch (ThreadAbortException abortEx)
            {
                Logger.Log("Monitoreo detenido.");
                Logger.Log(abortEx.Message);
                return;
            }
            catch (ThreadInterruptedException interruptEx)
            {
                Logger.Log("Despertando...");
                mon = new Thread(this.monitorear);
                mon.Start();
                return;
            }
            catch (MySqlException mySqlEx)
            {
                Logger.Log("Error en el monitoreo: " + mySqlEx.Message);
                return;
            }
            catch (Exception Ex)
            {
                Logger.Log("Error en el monitoreo: " + Ex.Message);
                return;
            }
        }
    }
}
