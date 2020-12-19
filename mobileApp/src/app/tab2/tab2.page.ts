import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ToastController, ModalController } from '@ionic/angular';
import { CheckoutModalPage } from '../checkout-modal/checkout-modal.page';
import { Router } from '@angular/router';

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})
export class Tab2Page {

  constructor(
    private http: HttpClient,
    private toastController: ToastController,
    private modalController: ModalController,
    private router: Router
  ) { }

  token = localStorage.getItem('token')
  datas: any = []
  total: number

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

  async notif(msg, color) {
    const toast = await this.toastController.create({
      message: msg,
      color: color,
      duration: 500
    });
    toast.present();
  }

  async showModal(datas, total) {
    const modal = await this.modalController.create({
      component: CheckoutModalPage,
      componentProps: { 'datas': datas, 'total': total }
    })
    return await modal.present()
  }

  getData() {
    let data: any
    this.http.get('http://localhost:8080/api/penjualantmp/' + localStorage.getItem('token'))
      .subscribe(response => {
        data = response
        this.datas = data.data
        this.total = data.total
      })
  }

  deleteTmp(produk) {
    let data: any
    this.http.delete('http://localhost:8080/api/penjualantmp/' + produk + '/' + localStorage.getItem('token'))
      .subscribe(response => {
        data = response
        if (data.status == true) {
          this.getData()
        }
        return
      })
  }

  changeTmp(produk, jumlah) {
    let data: any
    if (jumlah < 1) {
      return this.deleteTmp(produk)
    }
    this.http.put('http://localhost:8080/api/penjualantmp/' + produk + '/' + localStorage.getItem('token'), 'jumlah=' + jumlah, { headers: { 'Content-Type': 'application/x-www-form-urlencoded' } })
      .subscribe(response => {
        data = response
        if (data.status == true) {
          this.getData()
        }
      })
  }

}
