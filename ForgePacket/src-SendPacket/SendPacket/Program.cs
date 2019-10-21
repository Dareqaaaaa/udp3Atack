using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using PacketGen.OPCODES;

namespace PacketGen
{
    class Program
    {
        static void Main(string[] args)
        {
            switch (args[0])
            {
                case "chat":
                    SendPacket(new LOBBY_CHATTING_PAK(args[1], args[2]));
                    break;
                case "announce":
                    SendPacket(new SERVER_MESSAGE_ANNOUNCE_PAK(Convert.ToInt32(args[1]), args[2]));
                    break;
                case "bug_rank_up":
                    SendPacket(new SERVER_MESSAGE_EVENT_RANKUP_PAK());
                    break;

            }
        }



        public static void SendPacket(SendPacket bp)
        {
            try
            {
                using (bp)
                {
                    bp.write();
                    byte[] data = bp.mstream.ToArray();
                    if (data.Length < 2)
                        return;
                    ushort size = Convert.ToUInt16(data.Length - 2);
                    List<byte> list = new List<byte>(data.Length + 2);
                    list.AddRange(BitConverter.GetBytes(size));
                    list.AddRange(data);
                    byte[] result = list.ToArray();
                    if (true)
                    {
                        string debugData = "";
                        foreach (string str2 in BitConverter.ToString(result).Split('-', ',', '.', ':', '\t'))
                            debugData += " " + str2;
                        Console.WriteLine(debugData);
                    }
                }
            }
            catch
            {
            }
        }
    }
}
