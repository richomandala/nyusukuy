import { Component, OnInit, Input } from '@angular/core';
import { ModalController, ToastController } from '@ionic/angular';
import { FormControl, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-checkout-modal',
  templateUrl: './checkout-modal.page.html',
  styleUrls: ['./checkout-modal.page.scss'],
})
export class CheckoutModalPage implements OnInit {

  constructor(
    private modalController: ModalController,
    private toastController: ToastController,
    private http: HttpClient
  ) { }

  @Input() datas: any
  @Input() total: number

  nama = new FormControl('', Validators.required)
  uang = new FormControl('', Validators.required)

  ngOnInit() {

  }

  async notif(msg, color) {
    const toast = await this.toastController.create({
      message: msg,
      color: color,
      duration: 500
    });
    await toast.present();
  }

  bayar() {
    if (this.total > this.uang.value) {
      this.uang.reset()
      this.notif("Uang tidak mencukupi", "danger")
    } else {
      let produk_id: any = []
      let jumlah: any = []
      for (let i = 0; i < this.datas.length; i++) {
        produk_id.push(this.datas[i].produk_id)
        jumlah.push(this.datas[i].jumlah)
      }
      let data: any
      this.http.post('http://localhost:8080/api/penjualan', "pembeli=" + this.nama.value + "&bayar=" + this.uang.value + "&produk_id=" + produk_id + "&jumlah=" + jumlah, { headers: { 'Content-Type': 'application/x-www-form-urlencoded' } })
        .subscribe(response => {
          console.log(response)
          data = response
          if (data.error < 1) {
            for (let i = 0; i < data.message.length; i++) {
              this.notif(data.message[i], "success")
              location.href = './tabs/tab1'
            }
          } else {
            for (let i = 0; i < data.message.length; i++) {
              this.notif(data.message[i], "danger")
            }
          }
        })
    }
  }

  dismissModal() {
    this.modalController.dismiss()
  }

}
