import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { PenjualanModalPage } from './penjualan-modal.page';

describe('PenjualanModalPage', () => {
  let component: PenjualanModalPage;
  let fixture: ComponentFixture<PenjualanModalPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PenjualanModalPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(PenjualanModalPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
