using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Net.Mail;
using System.Net;

namespace SAT_Monitoreo
{
    class Cartero
    {
        public static void enviarCorreo(string destino, string msg)
        {
            SmtpClient mailClient = new SmtpClient(Parametros.ServidorCorreo);
            NetworkCredential cred = new NetworkCredential(Parametros.UsuarioCorreo, Parametros.ContrasenaCorreo);

            mailClient.Credentials = cred;
            try
            {
                mailClient.Send(Parametros.DireccionCorreo, destino, "SAT - Alerta", msg);
            }
            catch (Exception ex)
            {
                Logger.Log("Error: " + ex.Message);
            }

        }
    }
}
