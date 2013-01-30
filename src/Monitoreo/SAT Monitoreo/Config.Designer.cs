namespace SAT_Monitoreo
{
    partial class Config
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.cbSalida = new System.Windows.Forms.ComboBox();
            this.Dispositivo = new System.Windows.Forms.Label();
            this.gbLlamadas = new System.Windows.Forms.GroupBox();
            this.btnPrueba = new System.Windows.Forms.Button();
            this.numIntentos = new System.Windows.Forms.NumericUpDown();
            this.label3 = new System.Windows.Forms.Label();
            this.tbExtSalida = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.cbMarcarSalida = new System.Windows.Forms.CheckBox();
            this.label1 = new System.Windows.Forms.Label();
            this.tapi = new JulMar.Tapi3.TTapi();
            this.tabControl1 = new System.Windows.Forms.TabControl();
            this.tbLlamadas = new System.Windows.Forms.TabPage();
            this.tbCorreo = new System.Windows.Forms.TabPage();
            this.tbGeneral = new System.Windows.Forms.TabPage();
            this.label4 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.tbServidorCorreo = new System.Windows.Forms.TextBox();
            this.tbContrasenaCorreo = new System.Windows.Forms.TextBox();
            this.tbUsuarioCorreo = new System.Windows.Forms.TextBox();
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.btnGuardar = new System.Windows.Forms.Button();
            this.btnCancelar = new System.Windows.Forms.Button();
            this.label7 = new System.Windows.Forms.Label();
            this.dtIntervalo = new System.Windows.Forms.DateTimePicker();
            this.gbLlamadas.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.numIntentos)).BeginInit();
            this.tabControl1.SuspendLayout();
            this.tbLlamadas.SuspendLayout();
            this.tbCorreo.SuspendLayout();
            this.tbGeneral.SuspendLayout();
            this.groupBox1.SuspendLayout();
            this.groupBox2.SuspendLayout();
            this.SuspendLayout();
            // 
            // cbSalida
            // 
            this.cbSalida.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.cbSalida.Enabled = false;
            this.cbSalida.FormattingEnabled = true;
            this.cbSalida.Location = new System.Drawing.Point(88, 209);
            this.cbSalida.Name = "cbSalida";
            this.cbSalida.Size = new System.Drawing.Size(210, 21);
            this.cbSalida.TabIndex = 0;
            // 
            // Dispositivo
            // 
            this.Dispositivo.AutoSize = true;
            this.Dispositivo.Enabled = false;
            this.Dispositivo.Location = new System.Drawing.Point(21, 212);
            this.Dispositivo.Name = "Dispositivo";
            this.Dispositivo.Size = new System.Drawing.Size(61, 13);
            this.Dispositivo.TabIndex = 1;
            this.Dispositivo.Text = "Dispositivo:";
            // 
            // gbLlamadas
            // 
            this.gbLlamadas.Controls.Add(this.btnPrueba);
            this.gbLlamadas.Controls.Add(this.numIntentos);
            this.gbLlamadas.Controls.Add(this.label3);
            this.gbLlamadas.Controls.Add(this.tbExtSalida);
            this.gbLlamadas.Controls.Add(this.label2);
            this.gbLlamadas.Controls.Add(this.cbMarcarSalida);
            this.gbLlamadas.Controls.Add(this.label1);
            this.gbLlamadas.Controls.Add(this.Dispositivo);
            this.gbLlamadas.Controls.Add(this.cbSalida);
            this.gbLlamadas.Location = new System.Drawing.Point(6, 6);
            this.gbLlamadas.Name = "gbLlamadas";
            this.gbLlamadas.Size = new System.Drawing.Size(305, 138);
            this.gbLlamadas.TabIndex = 2;
            this.gbLlamadas.TabStop = false;
            this.gbLlamadas.Text = "Llamadas";
            // 
            // btnPrueba
            // 
            this.btnPrueba.Enabled = false;
            this.btnPrueba.Location = new System.Drawing.Point(161, 279);
            this.btnPrueba.Name = "btnPrueba";
            this.btnPrueba.Size = new System.Drawing.Size(75, 24);
            this.btnPrueba.TabIndex = 7;
            this.btnPrueba.Text = "Prueba";
            this.btnPrueba.UseVisualStyleBackColor = true;
            this.btnPrueba.Click += new System.EventHandler(this.btnPrueba_Click);
            // 
            // numIntentos
            // 
            this.numIntentos.Enabled = false;
            this.numIntentos.Location = new System.Drawing.Point(88, 236);
            this.numIntentos.Maximum = new decimal(new int[] {
            10,
            0,
            0,
            0});
            this.numIntentos.Name = "numIntentos";
            this.numIntentos.Size = new System.Drawing.Size(120, 20);
            this.numIntentos.TabIndex = 1;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Enabled = false;
            this.label3.Location = new System.Drawing.Point(34, 238);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(48, 13);
            this.label3.TabIndex = 6;
            this.label3.Text = "Intentos:";
            // 
            // tbExtSalida
            // 
            this.tbExtSalida.Location = new System.Drawing.Point(76, 22);
            this.tbExtSalida.Name = "tbExtSalida";
            this.tbExtSalida.Size = new System.Drawing.Size(67, 20);
            this.tbExtSalida.TabIndex = 3;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(10, 25);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(60, 13);
            this.label2.TabIndex = 4;
            this.label2.Text = "Ext. Salida:";
            // 
            // cbMarcarSalida
            // 
            this.cbMarcarSalida.AutoSize = true;
            this.cbMarcarSalida.Enabled = false;
            this.cbMarcarSalida.Location = new System.Drawing.Point(88, 262);
            this.cbMarcarSalida.Name = "cbMarcarSalida";
            this.cbMarcarSalida.Size = new System.Drawing.Size(15, 14);
            this.cbMarcarSalida.TabIndex = 2;
            this.cbMarcarSalida.UseVisualStyleBackColor = true;
            this.cbMarcarSalida.CheckedChanged += new System.EventHandler(this.cbMarcarSalida_CheckedChanged);
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Enabled = false;
            this.label1.Location = new System.Drawing.Point(9, 262);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(73, 13);
            this.label1.TabIndex = 2;
            this.label1.Text = "Marcar salida:";
            // 
            // tabControl1
            // 
            this.tabControl1.Controls.Add(this.tbGeneral);
            this.tabControl1.Controls.Add(this.tbCorreo);
            this.tabControl1.Controls.Add(this.tbLlamadas);
            this.tabControl1.Location = new System.Drawing.Point(12, 12);
            this.tabControl1.Name = "tabControl1";
            this.tabControl1.SelectedIndex = 0;
            this.tabControl1.Size = new System.Drawing.Size(325, 177);
            this.tabControl1.TabIndex = 3;
            // 
            // tbLlamadas
            // 
            this.tbLlamadas.Controls.Add(this.gbLlamadas);
            this.tbLlamadas.Location = new System.Drawing.Point(4, 22);
            this.tbLlamadas.Name = "tbLlamadas";
            this.tbLlamadas.Padding = new System.Windows.Forms.Padding(3);
            this.tbLlamadas.Size = new System.Drawing.Size(317, 151);
            this.tbLlamadas.TabIndex = 0;
            this.tbLlamadas.Text = "Llamadas";
            this.tbLlamadas.UseVisualStyleBackColor = true;
            // 
            // tbCorreo
            // 
            this.tbCorreo.Controls.Add(this.groupBox1);
            this.tbCorreo.Location = new System.Drawing.Point(4, 22);
            this.tbCorreo.Name = "tbCorreo";
            this.tbCorreo.Padding = new System.Windows.Forms.Padding(3);
            this.tbCorreo.Size = new System.Drawing.Size(317, 151);
            this.tbCorreo.TabIndex = 1;
            this.tbCorreo.Text = "Correo Electrónico";
            this.tbCorreo.UseVisualStyleBackColor = true;
            // 
            // tbGeneral
            // 
            this.tbGeneral.Controls.Add(this.groupBox2);
            this.tbGeneral.Location = new System.Drawing.Point(4, 22);
            this.tbGeneral.Name = "tbGeneral";
            this.tbGeneral.Size = new System.Drawing.Size(317, 151);
            this.tbGeneral.TabIndex = 2;
            this.tbGeneral.Text = "General";
            this.tbGeneral.UseVisualStyleBackColor = true;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(6, 34);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(100, 13);
            this.label4.TabIndex = 0;
            this.label4.Text = "Servidor de Correos";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Location = new System.Drawing.Point(63, 60);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(43, 13);
            this.label5.TabIndex = 1;
            this.label5.Text = "Usuario";
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Location = new System.Drawing.Point(45, 90);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(61, 13);
            this.label6.TabIndex = 2;
            this.label6.Text = "Contraseña";
            // 
            // tbServidorCorreo
            // 
            this.tbServidorCorreo.Location = new System.Drawing.Point(112, 31);
            this.tbServidorCorreo.Name = "tbServidorCorreo";
            this.tbServidorCorreo.Size = new System.Drawing.Size(100, 20);
            this.tbServidorCorreo.TabIndex = 4;
            // 
            // tbContrasenaCorreo
            // 
            this.tbContrasenaCorreo.Location = new System.Drawing.Point(112, 83);
            this.tbContrasenaCorreo.Name = "tbContrasenaCorreo";
            this.tbContrasenaCorreo.Size = new System.Drawing.Size(100, 20);
            this.tbContrasenaCorreo.TabIndex = 6;
            // 
            // tbUsuarioCorreo
            // 
            this.tbUsuarioCorreo.Location = new System.Drawing.Point(112, 57);
            this.tbUsuarioCorreo.Name = "tbUsuarioCorreo";
            this.tbUsuarioCorreo.Size = new System.Drawing.Size(100, 20);
            this.tbUsuarioCorreo.TabIndex = 7;
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.label4);
            this.groupBox1.Controls.Add(this.tbUsuarioCorreo);
            this.groupBox1.Controls.Add(this.label5);
            this.groupBox1.Controls.Add(this.tbContrasenaCorreo);
            this.groupBox1.Controls.Add(this.label6);
            this.groupBox1.Controls.Add(this.tbServidorCorreo);
            this.groupBox1.Location = new System.Drawing.Point(6, 6);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(305, 145);
            this.groupBox1.TabIndex = 8;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "Correo Electrónico";
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.dtIntervalo);
            this.groupBox2.Controls.Add(this.label7);
            this.groupBox2.Location = new System.Drawing.Point(3, 3);
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.Size = new System.Drawing.Size(311, 145);
            this.groupBox2.TabIndex = 0;
            this.groupBox2.TabStop = false;
            this.groupBox2.Text = "General";
            // 
            // btnGuardar
            // 
            this.btnGuardar.Location = new System.Drawing.Point(181, 218);
            this.btnGuardar.Name = "btnGuardar";
            this.btnGuardar.Size = new System.Drawing.Size(75, 23);
            this.btnGuardar.TabIndex = 4;
            this.btnGuardar.Text = "Guardar";
            this.btnGuardar.UseVisualStyleBackColor = true;
            this.btnGuardar.Click += new System.EventHandler(this.btnGuardar_Click);
            // 
            // btnCancelar
            // 
            this.btnCancelar.Location = new System.Drawing.Point(262, 218);
            this.btnCancelar.Name = "btnCancelar";
            this.btnCancelar.Size = new System.Drawing.Size(75, 23);
            this.btnCancelar.TabIndex = 5;
            this.btnCancelar.Text = "Cancelar";
            this.btnCancelar.UseVisualStyleBackColor = true;
            this.btnCancelar.Click += new System.EventHandler(this.btnCancelar_Click);
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Location = new System.Drawing.Point(6, 25);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(107, 13);
            this.label7.TabIndex = 0;
            this.label7.Text = "Intervalo de Revisión";
            // 
            // dtIntervalo
            // 
            this.dtIntervalo.CustomFormat = "HH:mm:ss";
            this.dtIntervalo.Format = System.Windows.Forms.DateTimePickerFormat.Custom;
            this.dtIntervalo.Location = new System.Drawing.Point(119, 19);
            this.dtIntervalo.Name = "dtIntervalo";
            this.dtIntervalo.ShowUpDown = true;
            this.dtIntervalo.Size = new System.Drawing.Size(104, 20);
            this.dtIntervalo.TabIndex = 1;
            this.dtIntervalo.Value = new System.DateTime(1900, 1, 1, 0, 0, 0, 0);
            // 
            // Config
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(342, 253);
            this.Controls.Add(this.btnCancelar);
            this.Controls.Add(this.btnGuardar);
            this.Controls.Add(this.tabControl1);
            this.Name = "Config";
            this.Text = "Configuración";
            this.Load += new System.EventHandler(this.Config_Load);
            this.FormClosed += new System.Windows.Forms.FormClosedEventHandler(this.Config_FormClosed);
            this.gbLlamadas.ResumeLayout(false);
            this.gbLlamadas.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.numIntentos)).EndInit();
            this.tabControl1.ResumeLayout(false);
            this.tbLlamadas.ResumeLayout(false);
            this.tbCorreo.ResumeLayout(false);
            this.tbGeneral.ResumeLayout(false);
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            this.groupBox2.ResumeLayout(false);
            this.groupBox2.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.ComboBox cbSalida;
        private System.Windows.Forms.Label Dispositivo;
        private System.Windows.Forms.GroupBox gbLlamadas;
        private System.Windows.Forms.CheckBox cbMarcarSalida;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.NumericUpDown numIntentos;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button btnPrueba;
        private JulMar.Tapi3.TTapi tapi;
        private System.Windows.Forms.TabControl tabControl1;
        private System.Windows.Forms.TabPage tbGeneral;
        private System.Windows.Forms.TabPage tbCorreo;
        private System.Windows.Forms.TabPage tbLlamadas;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.GroupBox groupBox2;
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.Button btnGuardar;
        private System.Windows.Forms.Button btnCancelar;
        public System.Windows.Forms.DateTimePicker dtIntervalo;
        public System.Windows.Forms.TextBox tbExtSalida;
        public System.Windows.Forms.TextBox tbUsuarioCorreo;
        public System.Windows.Forms.TextBox tbContrasenaCorreo;
        public System.Windows.Forms.TextBox tbServidorCorreo;
    }
}