import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { PenjualanModalPage } from './penjualan-modal.page';

const routes: Routes = [
  {
    path: '',
    component: PenjualanModalPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PenjualanModalPageRoutingModule {}
