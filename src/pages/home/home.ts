import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';

import { FCM } from '@ionic-native/FCM';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  constructor(public fcm: FCM, public navCtrl: NavController) {
    this.startNotifications();
  }

  startNotifications(){
    this.fcm.subscribeToTopic('mycustomtopic');
    this.fcm.getToken().then(token=>{
      console.log(token);
    })
    this.fcm.onNotification().subscribe(data=>{
      if(data.wasTapped){
        console.log("Received in background");
      } else {
        console.log("Received in foreground");
      };
    })
    this.fcm.onTokenRefresh().subscribe(token=>{
      console.log(token);
    })
    this.fcm.unsubscribeFromTopic('mycustomtopic');
  }

  sendNotification(){
    console.log("send!");
  }

}
