#include <ESP8266WiFi.h>
#include <DNSServer.h>
#include <ESP8266WebServer.h>
#include <WiFiManager.h>
#include <SPI.h>
#include <MFRC522.h>
#define SS_PIN D4
#define RST_PIN D2

MFRC522 mfrc522(SS_PIN, RST_PIN); // Instance of the class

String data;

char server[] = "zeroguess.net";
WiFiClient client;

void setup() {
// put your setup code here, to run once:
Serial.begin(115200);
WiFiManager wifiManager;
Serial.println("Conecting.....");
wifiManager.autoConnect("HIGH VOLTAGES","12345");
Serial.println("connected");
SPI.begin();       // Init SPI bus
mfrc522.PCD_Init(); // Init MFRC522
Serial.println("RFID reading UID");
pinMode(D8,OUTPUT);
}
void loop() {
  digitalWrite(D8,HIGH);
  // put your main code here, to run repeatedly:
  if (!client.connect(server, 80)) {
    Serial.println("Connection failed");
    digitalWrite(D8,HIGH);
    return;
 }
    if ( mfrc522.PICC_IsNewCardPresent())
    {
        if ( mfrc522.PICC_ReadCardSerial())
        {
           Serial.print("Tag UID:");
           for (byte i = 0; i < 4; i++) 
           {
             Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? "0" : "");
             Serial.print(mfrc522.uid.uidByte[i], HEX);
             data += String(mfrc522.uid.uidByte[i], HEX);
           }
           mfrc522.PICC_HaltA();
           data.toUpperCase();

    String url ="/n08/SecurityLocker/Arduino.php?number="+ String(data);
    client.print(String("GET ") + url + " HTTP/1.0\r\n" +
               "Host: " + server + "\r\n" + 
               "Connection: close\r\n\r\n");
  }
  delay(5000);

  while(client.available())
 {
  String line = client.readStringUntil('\r');
  String response ="TRUE";
  //Serial.print(response);
  Serial.println(line);
   if(line.substring(1,5).equals(response))
   {
            Serial.print("Y ");
            digitalWrite(D8,HIGH);
            delay(5000);
            digitalWrite(D8,LOW);
   }else
        {
            Serial.print("N ");
            digitalWrite(D8,LOW);
            delay(10);

        }
  }
}
data="";
}
