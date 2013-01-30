using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading;

namespace SAT_Monitoreo
{
    class Logger
    {
        private static System.Windows.Forms.Form _forma;
        public static System.Windows.Forms.Form Forma
        {
            get
            {
                return _forma;
            }
            set
            {
                _forma = value;
            }
        }

        private static string _logFile;
        public static string LogFile
        {
            get
            {
                return _logFile;
            }
            set
            {
                _logFile = value;
            }
        }

        public static void startLog()
        {
            string msg = "*************** " +
                         "Log abierto: " + DateTime.Now.ToString("yyyy/MM/dd - HH:mm:ss") +
                         " ***************";
            Log(msg);
        }

        public static void stopLog()
        {
            string msg = "*************** " +
                         "Log cerrado: " + DateTime.Now.ToString("yyyy/MM/dd - HH:mm:ss") + 
                         " ***************";
            Log(msg);
        }

        public static void Log(string msg)
        {
            if (!System.IO.Directory.Exists(AppDomain.CurrentDomain.BaseDirectory + "\\logs"))
                System.IO.Directory.CreateDirectory(AppDomain.CurrentDomain.BaseDirectory + "\\logs");
            string file = AppDomain.CurrentDomain.BaseDirectory + "\\logs\\log" + DateTime.Today.ToString("yyyyMMdd") + ".log";
            System.IO.StreamWriter fs =  new System.IO.StreamWriter(file, true);
            fs.WriteLine("[" + DateTime.Now.ToString("yyyy/MM/dd - HH:mm:ss") + "] => " + msg);
            fs.Close();
            if (((Main)Forma).txtLog.InvokeRequired)
            {
                ((Main)Forma).Invoke(((Main)Forma).logger, new Object[] {
                    "[" + DateTime.Now.ToString("yyyy/MM/dd - HH:mm:ss") + "] => " + msg + "\n"
                });
            }
            else
            {
                ((Main)Forma).logger("[" + DateTime.Now.ToString("yyyy/MM/dd - HH:mm:ss") + "] => " + msg + "\n");
            }
            //((Main)Forma).Invoke(
        }
    }
}
