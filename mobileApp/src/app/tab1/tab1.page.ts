import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ToastController, AlertController } from '@ionic/angular';
import { Router } from '@angular/router';

@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss']
})
export class Tab1Page {

  constructor(
    private router: Router,
    private http: HttpClient,
    private toastController: ToastController,
    private alertController: AlertController
  ) { }

  token = localStorage.getItem('token')
  datas: any = []

  ionViewWillEnter() {
    if (!this.token) {
      this.router.navigate(['login'])
    } else {
      this.http.get('http://localhost:8080/api/checklogin/' + this.token)
        .subscribe((res: any) => {
          if (!res) {
            this.router.navigate(['login'])
          }
        })
    }
    this.getData()
  }

  logout() {
    this.alertController.create({
      header: 'Keluar!',
      message: 'Yakin ingin keluar?',
      buttons: ['Cancel', {
        text: 'Keluar',
        handler: () => {
          this.http.get('http://localhost:8080/api/logout/' + this.token)
            .subscribe((res: any) => {
              if (res) {
                this.notif('Berhasil keluar', 'success')
                localStorage.removeItem('token')
                this.router.navigate(['login'])
              } else {
                this.notif('Gagal keluar', 'danger')
              }
            })
        }
      }]
    }).then(res => {

      res.present();

    });
  }

  async notif(msg, color) {
    const toast = await this.toastController.create({
      message: msg,
      color: color,
      duration: 500
    });
    toast.present();
  }

  getData() {
    let data: any
    this.http.get('http://localhost:8080/api/produk')
      .subscribe(response => {
        data = response
        this.datas = data.data
      })
  }

  saveTmp(produk) {
    let data: any
    let msg: string
    let color: string
    this.http.post('http://localhost:8080/api/penjualantmp', 'id=' + produk + '&token=' + localStorage.getItem('token'), { headers: { 'Content-Type': 'application/x-www-form-urlencoded' } })
      .subscribe(response => {
        data = response
        if (data.status == true) {
          msg = "Berhasil menambahkan produk"
          color = "success"
        } else {
          msg = "Gagal menambahkan produk"
          color = "danger"
        }
        this.notif(msg, color)
      })
  }

}
