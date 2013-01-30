using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Text;
using System.Windows.Forms;


namespace SAT_Monitoreo
{
    public partial class Main : Form
    {
        private Monitor m;
        public Main()
        {
            InitializeComponent();
        }

        private void configuracionToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (m != null && m.Monitoreando)
            {
                MessageBox.Show("El sistema aún está monitoreando.\nDetenga el monitoreo antes de hacer un cambio a la configuración.", "Advertencia!", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                return;
            }
            Config frmConfig = new Config();
            frmConfig.ShowDialog();
            frmConfig.Dispose();
        }

        private void pruebaToolStripMenuItem_Click(object sender, EventArgs e)
        {
            LlamadaPrueba frmPrueba = new LlamadaPrueba(0);
            frmPrueba.ShowDialog();
        }

        private void Main_Load(object sender, EventArgs e)
        {
            logger = loggear;
            Logger.Forma = this;
            Logger.startLog();
            Parametros.getParametros();
        }

        private void Main_FormClosing(object sender, FormClosingEventArgs e)
        {
            if (m != null && m.Monitoreando)
            {
                MessageBox.Show("El sistema aún está monitoreando.\nDetenga el monitoreo antes de cerrar.", "Advertencia!", MessageBoxButtons.OK, MessageBoxIcon.Warning);
                e.Cancel = true;
            }
            else
            {
                Logger.stopLog();
            }
        }

        private void iniciarToolStripMenuItem_Click(object sender, EventArgs e)
        {
            m = new Monitor();
            m.iniciarMonitoreo();
            detenerToolStripMenuItem.Enabled = true;
            iniciarToolStripMenuItem.Enabled = false;
        }

        private void detenerToolStripMenuItem_Click(object sender, EventArgs e)
        {
            m.detenerMonitoreo();
            detenerToolStripMenuItem.Enabled = false;
            iniciarToolStripMenuItem.Enabled = true;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Parametros.DireccionCorreo = "sat@pmdn.gob.hn";
            Parametros.ServidorCorreo = "dc-pmdn";
            Parametros.UsuarioCorreo = "";
            Parametros.ContrasenaCorreo = "";
            Cartero.enviarCorreo("gasman2k@hotmail.com", "Prueba SAT");
        }

        public void loggear(string msg)
        {
            this.txtLog.Text = msg + this.txtLog.Text;
        }

        public delegate void Log(string msg);
        public Log logger;

        private void forzarToolStripMenuItem_Click(object sender, EventArgs e)
        {
            if (m.Monitoreando)
                m.forzarMonitoreo();
        }

        private void txtLog_TextChanged(object sender, EventArgs e)
        {
            this.txtLog.ScrollToCaret();
        }
    }
}
