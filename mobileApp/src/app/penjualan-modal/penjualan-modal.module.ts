import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { PenjualanModalPageRoutingModule } from './penjualan-modal-routing.module';

import { PenjualanModalPage } from './penjualan-modal.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    PenjualanModalPageRoutingModule
  ],
  declarations: [PenjualanModalPage]
})
export class PenjualanModalPageModule {}
