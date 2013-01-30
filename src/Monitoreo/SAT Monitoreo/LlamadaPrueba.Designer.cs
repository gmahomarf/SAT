namespace SAT_Monitoreo
{
    partial class LlamadaPrueba
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
            this.label1 = new System.Windows.Forms.Label();
            this.tbTexto = new System.Windows.Forms.TextBox();
            this.label2 = new System.Windows.Forms.Label();
            this.tbNumero = new System.Windows.Forms.MaskedTextBox();
            this.btnLlamar = new System.Windows.Forms.Button();
            this.btnCancelar = new System.Windows.Forms.Button();
            this.cbVoces = new System.Windows.Forms.ComboBox();
            this.label3 = new System.Windows.Forms.Label();
            this.cbAudioOuts = new System.Windows.Forms.ComboBox();
            this.label4 = new System.Windows.Forms.Label();
            this.tapi = new JulMar.Tapi3.TTapi();
            this.label5 = new System.Windows.Forms.Label();
            this.cbSalidas = new System.Windows.Forms.ComboBox();
            this.SuspendLayout();
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(26, 49);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(47, 13);
            this.label1.TabIndex = 1;
            this.label1.Text = "Número:";
            // 
            // tbTexto
            // 
            this.tbTexto.Location = new System.Drawing.Point(79, 77);
            this.tbTexto.Multiline = true;
            this.tbTexto.Name = "tbTexto";
            this.tbTexto.Size = new System.Drawing.Size(201, 73);
            this.tbTexto.TabIndex = 2;
            this.tbTexto.Text = "Esta es una prueba";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(7, 80);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(66, 13);
            this.label2.TabIndex = 3;
            this.label2.Text = "Texto a leer:";
            // 
            // tbNumero
            // 
            this.tbNumero.Location = new System.Drawing.Point(79, 46);
            this.tbNumero.Mask = "99999999";
            this.tbNumero.Name = "tbNumero";
            this.tbNumero.Size = new System.Drawing.Size(100, 20);
            this.tbNumero.TabIndex = 4;
            this.tbNumero.Text = "121";
            // 
            // btnLlamar
            // 
            this.btnLlamar.Location = new System.Drawing.Point(124, 222);
            this.btnLlamar.Name = "btnLlamar";
            this.btnLlamar.Size = new System.Drawing.Size(75, 23);
            this.btnLlamar.TabIndex = 5;
            this.btnLlamar.Text = "Llamar";
            this.btnLlamar.UseVisualStyleBackColor = true;
            this.btnLlamar.Click += new System.EventHandler(this.btnLlamar_Click);
            // 
            // btnCancelar
            // 
            this.btnCancelar.DialogResult = System.Windows.Forms.DialogResult.Cancel;
            this.btnCancelar.Location = new System.Drawing.Point(205, 222);
            this.btnCancelar.Name = "btnCancelar";
            this.btnCancelar.Size = new System.Drawing.Size(75, 23);
            this.btnCancelar.TabIndex = 6;
            this.btnCancelar.Text = "Cancelar";
            this.btnCancelar.UseVisualStyleBackColor = true;
            this.btnCancelar.Click += new System.EventHandler(this.btnCancelar_Click);
            // 
            // cbVoces
            // 
            this.cbVoces.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.cbVoces.DropDownWidth = 500;
            this.cbVoces.FormattingEnabled = true;
            this.cbVoces.Location = new System.Drawing.Point(79, 157);
            this.cbVoces.Name = "cbVoces";
            this.cbVoces.Size = new System.Drawing.Size(201, 21);
            this.cbVoces.TabIndex = 7;
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(45, 160);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(28, 13);
            this.label3.TabIndex = 8;
            this.label3.Text = "Voz:";
            // 
            // cbAudioOuts
            // 
            this.cbAudioOuts.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.cbAudioOuts.DropDownWidth = 500;
            this.cbAudioOuts.FormattingEnabled = true;
            this.cbAudioOuts.Location = new System.Drawing.Point(79, 184);
            this.cbAudioOuts.Name = "cbAudioOuts";
            this.cbAudioOuts.Size = new System.Drawing.Size(201, 21);
            this.cbAudioOuts.TabIndex = 9;
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(16, 187);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(57, 13);
            this.label4.TabIndex = 10;
            this.label4.Text = "Audio Out:";
            // 
            // tapi
            // 
            this.tapi.TE_TTSTERMINAL += new System.EventHandler<JulMar.Tapi3.TapiTTSTerminalEventArgs>(this.tapi_TE_TTSTERMINAL);
            this.tapi.TE_CALLMEDIA += new System.EventHandler<JulMar.Tapi3.TapiCallMediaEventArgs>(this.tapi_TE_CALLMEDIA);
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Location = new System.Drawing.Point(34, 24);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(39, 13);
            this.label5.TabIndex = 11;
            this.label5.Text = "Salida:";
            // 
            // cbSalidas
            // 
            this.cbSalidas.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.cbSalidas.DropDownWidth = 500;
            this.cbSalidas.FormattingEnabled = true;
            this.cbSalidas.Location = new System.Drawing.Point(79, 21);
            this.cbSalidas.Name = "cbSalidas";
            this.cbSalidas.Size = new System.Drawing.Size(201, 21);
            this.cbSalidas.TabIndex = 12;
            // 
            // LlamadaPrueba
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.CancelButton = this.btnCancelar;
            this.ClientSize = new System.Drawing.Size(292, 257);
            this.Controls.Add(this.cbSalidas);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.cbAudioOuts);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.cbVoces);
            this.Controls.Add(this.btnCancelar);
            this.Controls.Add(this.btnLlamar);
            this.Controls.Add(this.tbNumero);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.tbTexto);
            this.Controls.Add(this.label1);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedDialog;
            this.Name = "LlamadaPrueba";
            this.Text = "LlamadaPrueba";
            this.Load += new System.EventHandler(this.LlamadaPrueba_Load);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox tbTexto;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.MaskedTextBox tbNumero;
        private System.Windows.Forms.Button btnLlamar;
        private System.Windows.Forms.Button btnCancelar;
        private System.Windows.Forms.ComboBox cbVoces;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.ComboBox cbAudioOuts;
        private System.Windows.Forms.Label label4;
        private JulMar.Tapi3.TTapi tapi;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.ComboBox cbSalidas;
    }
}