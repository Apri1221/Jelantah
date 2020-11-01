export class PubSub {
    constructor(element, topic = "/cloudmqtt") {
        // suatu saat, id ini dari suatu sistem yg kompleks
        const client_id = "web_" + parseInt(Math.random() * 100, 10);
        // subscribe ke topic user
        this.topic = topic;
        // ubah nilai element ketika message arrive
        this.element = element;
        
        // buat instansiasi client
        this.client = new Paho.Client("tailor.cloudmqtt.com", 36503, client_id);

        // set callback handlers
        this.client.onConnectionLost = this.onConnectionLost.bind(this);
        this.client.onMessageArrived = this.onMessageArrived.bind(this);

        // registrasi method pada kelas PubSub
        this.onConnect = this.onConnect.bind(this);
        this.onFailure = this.doFail.bind(this);
        this.disconnect = this.disconnect.bind(this);

        const options = {
            useSSL: true,
            userName: "lvntsnrq",
            password: "79W8iNWE4G9i",
            onSuccess: this.onConnect, // method
            onFailure: this.doFail // method
        }

        // connect
        this.client.connect(options);
    }

    // dipanggil ketika client connect
    onConnect() {
        // subscribe ke topik yang diinginkan, misal /topik-user-12
        this.client.subscribe(this.topic);
        console.log(`terhubung dengan topik ${this.topic}`);
        M.toast({html: `terhubung dengan topik ${this.topic}`, classes: 'green darken-2 flow-text'})
    }

    doFail(e) {
        console.log("tidak bisa terhubung" + e);
        M.toast({html: `koneksi gagal cloudmqtt`, classes: 'red darken-4 flow-text'})
    }

    // called when the client loses its connection
    onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            console.log(`koneksi hilang: ${responseObject.errorMessage}`);
            M.toast({html: `koneksi hilang: ${responseObject.errorMessage}`, classes: 'amber darken-4 flow-text'})
        }
    }

    // called when a message arrives
    onMessageArrived(message) {
        // console.log("onMessageArrived:" + message.payloadString);
        console.log(`message diterima dari topik: ${message.destinationName}`);
        this.element.innerHTML = `${message.payloadString}%`;
        this.element.style.width = `${message.payloadString}%`;
    }

    disconnect() {
        console.log("client is disconnecting..");
        M.toast({html: `memutuskan koneksi dengan broker`, classes: 'amber darken-4 flow-text'})
        this.client.disconnect();
    }
}
