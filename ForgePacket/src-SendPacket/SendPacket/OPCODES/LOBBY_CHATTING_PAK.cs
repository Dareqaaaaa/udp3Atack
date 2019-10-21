
namespace PacketGen.OPCODES
{
    class LOBBY_CHATTING_PAK : SendPacket
    {
        private string sender, msg;
        private uint sessionId;
        private int nameColor;
        private bool GMColor;

        public LOBBY_CHATTING_PAK(string nick, string msgw)
        {
            nameColor = 1;
            GMColor = true;
            sender = nick;
            sessionId = 0;
            msg = msgw;
        }
        public override void write()
        {
            writeH(3093);
            writeD(0);
            writeC((byte)(sender.Length + 1));
            writeS(sender, sender.Length + 1);
            writeC((byte)nameColor);
            writeC(GMColor);
            writeH((ushort)(msg.Length + 1));
            writeS(msg, msg.Length + 1);
        }
    }
}
