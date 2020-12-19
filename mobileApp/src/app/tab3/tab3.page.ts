import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ModalController } from '@ionic/angular';
import { PenjualanModalPage } from '../penjualan-modal/penjualan-modal.page';
import { Router } from '@angular/router';

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss']
})
export class Tab3Page {

  constructor(
    private http: HttpClient,
    private modalController: ModalController,
    private router: Router
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

  async showModal(data) {
    const modal = await this.modalController.create({
      component: PenjualanModalPage,
      componentProps: { 'data': data }
    })
    return await modal.present()
  }

  getData() {
    let data: any
    this.http.get('http://localhost:8080/api/penjualan')
      .subscribe(response => {
        data = response
        this.datas = data.data
      })
  }

}
