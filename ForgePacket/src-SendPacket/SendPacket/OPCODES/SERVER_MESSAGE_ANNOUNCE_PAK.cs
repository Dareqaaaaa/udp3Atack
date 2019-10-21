namespace PacketGen.OPCODES
{
    class SERVER_MESSAGE_ANNOUNCE_PAK : SendPacket
    {
        private string _message;
        private int _type;
        public SERVER_MESSAGE_ANNOUNCE_PAK(int type, string msg)
        {
            _message = msg;
            _type = type;
        }

        public override void write()
        {
            writeH(2055);
            writeD(_type); //Tipo da notícia [NOTICE_TYPE_NORMAL - 1 || NOTICE_TYPE_EMERGENCY - 2]
            writeH((ushort)_message.Length);
            writeS(_message);
        }
    }
}
