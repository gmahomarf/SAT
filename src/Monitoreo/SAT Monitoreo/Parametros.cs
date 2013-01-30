using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using MySql.Data.MySqlClient;

namespace SAT_Monitoreo
{
    class Parametros
    {
        private static DateTime _intervalo = new DateTime(2000,1,1,0,5,0);
        public static DateTime Intervalo
        {
            get
            {
                return _intervalo;
            }
            set
            {
                _intervalo = value;
            }
        }

        private static string _mx = "";
        public static string ServidorCorreo
        {
            get
            {
                return _mx;
            }
            set
            {
                _mx = value;
            }
        }

        private static string _mxUser = "";
        public static string UsuarioCorreo
        {
            get
            {
                return _mxUser;
            }
            set
            {
                _mxUser = value;
            }
        }

        private static string _mxPassword = "";
        public static string ContrasenaCorreo
        {
            get
            {
                return _mxPassword;
            }
            set
            {
                _mxPassword = value;
            }
        }

        private static string _mxDireccion = "sat@pmdn.gob.hn";
        public static string DireccionCorreo
        {
            get
            {
                return _mxDireccion;
            }
            set
            {
                _mxDireccion = value;
            }
        }

        private static string _extSalida = "";
        public static string ExtensionSalida
        {
            get
            {
                return _extSalida;
            }
            set
            {
                _extSalida = value;
            }
        }


        public static bool getParametros()
        {
            string query = "SELECT * FROM sat.parametrossistema;";
            bool hay = false;
            MySqlConnection con = new MySqlConnection(Properties.Resources.MySqlConn);
            MySqlConnection con1 = new MySqlConnection(Properties.Resources.MySqlConn);
            MySqlCommand cmd = new MySqlCommand(query, con);
            MySqlDataReader rdr;
            if (con.State != System.Data.ConnectionState.Open)
            {
                con.Open();
            }
            rdr = cmd.ExecuteReader();
            if (rdr.Read())
            {
                hay = true;
                TimeSpan ts = rdr.GetTimeSpan("intervalo_revision");
                Intervalo = new DateTime(2000, 1, 1, ts.Hours, ts.Minutes, ts.Seconds);
                ServidorCorreo = rdr.IsDBNull(2) ? "" : rdr.GetString("servidor_correos");
                UsuarioCorreo = rdr.IsDBNull(3) ? "" : rdr.GetString("usuario_correo");
                ContrasenaCorreo = rdr.IsDBNull(4) ? "" : rdr.GetString("contrasena_correo");
                ExtensionSalida = rdr.IsDBNull(5) ? "" : rdr.GetString("extension_salida");
            }
            if (con.State == System.Data.ConnectionState.Open)
            {
                con.Close();
            }
            if (!hay)
            {
                MySqlCommand cmd2 = new MySqlCommand(
                    "INSERT INTO sat.parametrossistema (intervalo_revision) " +
                    "VALUES ('00:05:00');", con1);
                cmd = new MySqlCommand(query, con);
                if (con.State != System.Data.ConnectionState.Open)
                {
                    con.Open();
                }
                if (con1.State != System.Data.ConnectionState.Open)
                {
                    con1.Open();
                }
                cmd2.ExecuteNonQuery();
                rdr = cmd.ExecuteReader();
                if (rdr.Read())
                {
                    hay = true;
                    TimeSpan ts = rdr.GetTimeSpan("intervalo_revision");
                    Intervalo = new DateTime(2000, 1, 1, ts.Hours, ts.Minutes, ts.Seconds);
                
                }
                Logger.Log("Parámetros leídos");
                if (con.State == System.Data.ConnectionState.Open)
                {
                    con.Close();
                }
                if (con1.State == System.Data.ConnectionState.Open)
                {
                    con1.Close();
                }
                return true;
            }
            else
            {
                Logger.Log("Parámetros leídos");
                if (con.State == System.Data.ConnectionState.Open)
                {
                    con.Close();
                }
                return true;
            }
            return false;
        }

        public static bool saveParametros(Config cfg)
        {
            MySqlConnection con = new MySqlConnection(Properties.Resources.MySqlConn);
            MySqlCommand cmd = new MySqlCommand("", con);
            UsuarioCorreo = cfg.tbUsuarioCorreo.Text;
            ServidorCorreo = cfg.tbServidorCorreo.Text;
            ContrasenaCorreo = cfg.tbContrasenaCorreo.Text;
            Intervalo = cfg.dtIntervalo.Value;
            string comm = "UPDATE sat.parametrossistema " +
                          "SET intervalo_revision  = '" + Intervalo.ToString("HH:mm:ss") + "', " +
                          "servidor_correos = '" + ServidorCorreo + "', " +
                          "usuario_correo = '" + UsuarioCorreo + "', " +
                          "contrasena_correo = '" + ContrasenaCorreo + "', " +
                          "extension_salida = '" + ExtensionSalida + "'; ";
            cmd.CommandText = comm;
            if (con.State != System.Data.ConnectionState.Open)
            {
                con.Open();
            }
            cmd.ExecuteNonQuery();
            if (con.State == System.Data.ConnectionState.Open)
            {
                con.Close();
            }
            return true;
        }
    }
}
