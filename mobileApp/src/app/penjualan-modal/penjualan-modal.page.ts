import { Component, OnInit, Input } from '@angular/core';
import { ModalController } from '@ionic/angular';

@Component({
  selector: 'app-penjualan-modal',
  templateUrl: './penjualan-modal.page.html',
  styleUrls: ['./penjualan-modal.page.scss'],
})
export class PenjualanModalPage implements OnInit {

  constructor(private modalController: ModalController) { }

  @Input() data: any
  products: any = []

  ngOnInit() {
    let pp = this.data.produk_produk.split(',')
    let jj = this.data.jumlah_jumlah.split(',')
    let hh = this.data.harga_harga.split(',')
    let tt = this.data.total_total.split(',')
    for (let i = 0; i < pp.length; i++) {
      this.products.push({
        'produk': pp[i],
        'jumlah': jj[i],
        'harga': hh[i],
        'total': tt[i]
      })
    }
  }

  dismissModal() {
    this.modalController.dismiss()
  }

}
