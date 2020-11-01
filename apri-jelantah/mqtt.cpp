// declaration
#include <PubSubClient.h>
#include <WiFi.h>
#define WIFI_AP "Andar"
#define WIFI_PASSWORD "29091963"

// cloud
const char *server = "tailor.cloudmqtt.com";
const int mqttPort = 16503;
const char *mqttUser = "lvntsnrq";
const char *mqttPass = "79W8iNWE4G9i";

static const char alphanum[] = "0123456789"
                               "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
                               "abcdefghijklmnopqrstuvwxyz"; // For random generation of client ID.

WiFiClient client;               // Initialize the Wifi client library.
PubSubClient mqttClient(client); // Initialize the PuBSubClient library.

unsigned long lastConnectionTime = 0;
const unsigned long postingInterval = 6L * 1000L; // Post data every 6 seconds.

// defines pins numbers
const int trigPin = 2;
const int echoPin = 5;

// store global
long duration;
long distance;

void setup()
{
    // put your setup code here, to run once:
    pinMode(trigPin, OUTPUT); // Sets the trigPin as an Output
    pinMode(echoPin, INPUT);  // Sets the echoPin as an Input
    Serial.begin(115200);
    delay(100);
    // koneksi ke wifi
    InitWiFi();
    mqttClient.setServer(server, mqttPort); // Set the MQTT broker details.
}

// looping
void loop()
{
    // pembacaan data dari sensor ultrasonic di fungsi terpisah
    ultrasonic();
    // Reconnect if MQTT client is not connected.
    if (!mqttClient.connected())
    {
        reconnect();
        mqttpublish();
    }

    mqttClient.loop(); // Call the loop continuously to establish connection to the server.

    // If interval time has passed since the last connection, Publish data to Cloudmqtt
    if (millis() - lastConnectionTime > postingInterval)
    {
        mqttpublish();
    }
}

void InitWiFi()
{
    Serial.println("Connecting to AP ...");
    // attempt to connect to WiFi network

    WiFi.begin(WIFI_AP, WIFI_PASSWORD);
    while (WiFi.status() != WL_CONNECTED)
    {
        delay(500);
        Serial.print(".");
    }
    Serial.println("Connected to AP");
}

void ultrasonic()
{
    // Clears the trigPin
    digitalWrite(trigPin, LOW);
    delayMicroseconds(5);

    // Sets the trigPin on HIGH state for 10 micro seconds
    digitalWrite(trigPin, HIGH);
    delayMicroseconds(10);
    digitalWrite(trigPin, LOW);

    // Reads the echoPin, returns the sound wave travel time in microseconds
    pinMode(echoPin, INPUT); // --> https://randomnerdtutorials.com/complete-guide-for-ultrasonic-sensor-hc-sr04/
    duration = pulseIn(echoPin, HIGH);

    // Calculating the distance
    // distance = duration * 0.034 / 2;
    distance = (duration / 2) / 29.1;

    // Prints the distance on the Serial Monitor
    Serial.print("Distance: ");
    Serial.println(distance);

    // let say the drum galoon height is 100 cm
    distance = distance > 100 ? 0 : 100 - distance;

    delay(2000);
}

// NOTE method reconnect ini bukan untuk koneksi wifi, tp ke channel
void reconnect()
{
    char clientID[9];

    // Loop until we're reconnected
    while (!mqttClient.connected())
    {
        Serial.print("Attempting MQTT connection...");
        // Generate ClientID
        for (int i = 0; i < 8; i++)
        {
            clientID[i] = alphanum[random(51)];
        }
        clientID[8] = '\0';

        // NOTE Connect to the MQTT broker dengan ID dan pass
        if (mqttClient.connect(clientID, mqttUser, mqttPass))
        {
            Serial.println("connected");
        }
        else
        {
            Serial.print("failed, rc=");
            // Print to know why the connection failed.
            // See https://pubsubclient.knolleary.net/api.html#state for the failure code explanation.
            Serial.print(mqttClient.state());
            Serial.println(" try again in 5 seconds");
            delay(5000);
        }
    }
}

// NOTE method mqtt dipanggil secara periodik di method loop
void mqttpublish()
{
    float t = 80; // Read temperature from DHT sensor.
    Serial.print("Sending: ");
    Serial.println(distance);
    char buf[100];
    gcvt(distance, 6, buf);

    // Create a topic string and publish data to Cloudmqtt channel feed.
    mqttClient.publish("/cloudmqtt", buf);
    lastConnectionTime = millis();
}