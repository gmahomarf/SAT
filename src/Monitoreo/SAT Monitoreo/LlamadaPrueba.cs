using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;

using System.Text;
using System.Windows.Forms;
using JulMar.Tapi3;
using SpeechLib;


namespace SAT_Monitoreo
{
    public partial class LlamadaPrueba : Form
    {
        private int address;
        private bool marcarSalida;
        private string salida;
        
        private SpVoiceClass voz;
        private SpObjectToken[] voces;
        private SpObjectToken[] audioOuts;

        public LlamadaPrueba()
        {
            InitializeComponent();
        }

        public LlamadaPrueba(int addr, bool mSal, string sal)
        {
            InitializeComponent();
            this.address = addr;
            this.marcarSalida = mSal;
            this.salida = sal;
        }

        public LlamadaPrueba(int addr)
        {
            InitializeComponent();
            this.address = addr;
            this.marcarSalida = false;
            this.salida = "";
        }

        private void LlamadaPrueba_Load(object sender, EventArgs e)
        {
            int x = 0, y = 0;
            voces = new SpObjectToken[30];
            audioOuts = new SpObjectToken[30];
            tapi.Initialize();
            //voice = new SpVoice();
            voz = new SpVoiceClass();
            foreach (TAddress addr in tapi.Addresses)
            {
                if ((addr.MediaTypes & TAPIMEDIATYPES.AUDIO) != 0)
                    cbSalidas.Items.Add(addr);
            }
            foreach (SpObjectToken tok in voz.GetVoices("", ""))
            {
                voces[x++] = tok;
                cbVoces.Items.Add(tok.GetDescription(1033));
            }
            foreach (SpObjectToken tok in voz.GetAudioOutputs("", ""))
            {
                audioOuts[y++] = tok;
                cbAudioOuts.Items.Add(tok.GetDescription(1033));
            }
            cbVoces.SelectedIndex = 0;
            cbAudioOuts.SelectedIndex = 0;
            cbSalidas.SelectedIndex = 0;
        }

        private void btnCancelar_Click(object sender, EventArgs e)
        {
            tapi.Shutdown();
            this.Close();
        }

        private void btnLlamar_Click(object sender, EventArgs e)
        {
            //voice.Speak("Hello, Nurse!", SpeechVoiceSpeakFlags.SVSFDefault);
            //SpMemoryStream stream = new SpMemoryStream();

            TAddress addr = (TAddress)cbSalidas.SelectedItem;
            addr.Open(TAPIMEDIATYPES.AUDIO);

            
            TCall call = addr.CreateCall(tbNumero.Text,
                LINEADDRESSTYPES.PhoneNumber, TAPIMEDIATYPES.AUDIO);
            TTerminal terminal = call.RequestTerminal(TTerminal.MediaStreamTerminal,
                TAPIMEDIATYPES.AUDIO, TERMINAL_DIRECTION.TD_CAPTURE);
            //SpMMAudioOutClass audOut = new SpMMAudioOutClass();
            SpCustomStream custm = new SpCustomStream();
            //audOut.SetDeviceId((uint)(byte)addr.GetID("wave/out").GetValue(0));

            //audOut.DeviceId *= 0x01000000;

            TStream strm;
            
            call.SelectTerminalOnCall(terminal);
            voz.AllowAudioOutputFormatChangesOnNextSet = false;
            voz.AudioOutputStream = custm;
            voz.SetVoice((ISpObjectToken)(voces[cbVoces.SelectedIndex]));
            //voz.SetOutput(audOut, 0);
            call.Connect(false);
            
            
           //voz.AudioOutput = (SpObjectToken)audOut.DeviceId;
            //voz.Speak(tbTexto.Text, SpeechVoiceSpeakFlags.SVSFDefault);

            //call.Disconnect(DISCONNECT_CODE.DC_NORMAL);
            //voz.SpeakStream(stream, SpeechVoiceSpeakFlags.SVSFDefault);*/
        }

        private void tapi_TE_TTSTERMINAL(object sender, TapiTTSTerminalEventArgs e)
        {
            TTerminal terminal = e.Terminal;
            TCall call = e.Call;
            //terminal.Start();

            //MessageBox.Show("Ready?");

            
        }

        private void tapi_TE_CALLMEDIA(object sender, TapiCallMediaEventArgs e)
        {
            if (e.Event == CALL_MEDIA_EVENT.CME_STREAM_ACTIVE)
            {
                TStream stm = e.Stream;
                /*if (stm.Direction == TERMINAL_DIRECTION.TD_RENDER &&
                    stm.MediaType == TAPIMEDIATYPES.VIDEO)
                {
                    
                }
                else */if (e.Call != null &&
                    stm.Direction == TERMINAL_DIRECTION.TD_CAPTURE &&
                    stm.MediaType == TAPIMEDIATYPES.AUDIO &&
                    e.Terminal != null)
                {
                    try
                    {
                        //e.Terminal.Start();
                        //voz.Voice = (SpObjectToken)voces[cbVoces.SelectedIndex];
                        //voz.AudioOutput = (SpObjectToken)audioOuts[cbAudioOuts.SelectedIndex];
                        voz.Speak(tbTexto.Text, SpeechVoiceSpeakFlags.SVSFDefault);
                        //e.Terminal.Stop();
                        e.Call.Disconnect(DISCONNECT_CODE.DC_NORMAL);
                        this.tapi.Addresses[address].Close();
                        //toolStripStatusLabel1.Text = "File Playback Terminal started ";
                    }
                    catch (TapiException ex)
                    {
                        MessageBox.Show(ex.Message);
                    }

                }
            }
        }
    }
}
