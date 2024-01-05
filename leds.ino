#include <HTTPClient.h>
#include <WiFi.h>
#include <ArduinoJson.h>

const char* ssid = "LabITP";
const char* password = "Advanced12345#";
const char* apiLed1 = "https://app.brandonperez.online/iot/backend/getLed.php";

int led1 = 4;
int led1StatusAnterior = -1;
int led1Status;
int httpCodeLed1;
String serverResponseLed1;

HTTPClient httpApiLed1;

void setup() {
  Serial.begin(115200);
  pinMode(led1, OUTPUT);

  // Configuración para conectarse a Wifi**************
  Serial.print("Conectando a: ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nConectado a WiFi");
  Serial.println("Dirección IP : ");
  Serial.println(WiFi.localIP());
  //***************************************************
}

void loop() {
  httpApiLed1.begin(apiLed1);
  httpApiLed1.addHeader("Content-Type", "application/x-www-form-urlencoded");
  httpCodeLed1 = httpApiLed1.GET();

  if (httpCodeLed1 == HTTP_CODE_OK) {
    serverResponseLed1 = httpApiLed1.getString();
    Serial.print("Respuesta del servidor: ");
    Serial.println(serverResponseLed1);

    DynamicJsonDocument doc(200);
    DeserializationError error = deserializeJson(doc, serverResponseLed1);

    if (error) {
      Serial.print("Error al deserializar JSON: ");
      Serial.println(error.c_str());
    } else {
      int ledStatus = doc["status"];

      if (ledStatus != led1StatusAnterior) {
        if (ledStatus == 1) {
          Serial.println("LED1: ON");
          digitalWrite(led1, HIGH);
        } else {
          Serial.println("LED1: OFF");
          digitalWrite(led1, LOW);
        }
      }

      led1StatusAnterior = ledStatus;
    }
  } else {
    Serial.print("Error en la solicitud HTTP. Código: ");
    Serial.println(httpCodeLed1);
  }

  httpApiLed1.end();

  delay(2000);
}
