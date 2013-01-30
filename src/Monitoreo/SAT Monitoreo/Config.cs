using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;

using System.Text;
using System.Windows.Forms;
using JulMar.Tapi3;

namespace SAT_Monitoreo
{
    public partial class Config : Form
    {
        public Config()
        {
            InitializeComponent();
        }

        private void Config_Load(object sender, EventArgs e)
        {
            /*// Initialize TAPI
            if (tapi.Initialize() == 0)
            {
                MessageBox.Show("No hay dispositivos disponibles para hacer llamadas.");
                return;
            }

            // Populate our address combo box with all the available addresses.
            foreach (TAddress addr in tapi.Addresses)
            {
                // Add each voice-capable address
                if ((addr.MediaTypes & TAPIMEDIATYPES.AUDIO) != 0)
                    cbSalida.Items.Add(addr);
            }

            cbSalida.SelectedIndex = 0;
            */
            Parametros.getParametros();
            dtIntervalo.Value = Parametros.Intervalo;
            tbContrasenaCorreo.Text = Parametros.ContrasenaCorreo;
            tbExtSalida.Text = Parametros.ExtensionSalida;
            tbUsuarioCorreo.Text = Parametros.UsuarioCorreo;
            tbServidorCorreo.Text = Parametros.ServidorCorreo;
        }

        private void cbMarcarSalida_CheckedChanged(object sender, EventArgs e)
        {
            tbExtSalida.Enabled = cbMarcarSalida.Checked;
        }

        private void btnPrueba_Click(object sender, EventArgs e)
        {
            LlamadaPrueba frmPrueba = new LlamadaPrueba(cbSalida.SelectedIndex);
            frmPrueba.ShowDialog();
        }

        private void Config_FormClosed(object sender, FormClosedEventArgs e)
        {
            //tapi.Shutdown();
        }

        private void btnGuardar_Click(object sender, EventArgs e)
        {
            Parametros.saveParametros(this);
            this.Close();
        }

        private void btnCancelar_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}
