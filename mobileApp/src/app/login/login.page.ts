import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { ToastController } from '@ionic/angular';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  constructor(
    private router: Router,
    private http: HttpClient,
    private toastController: ToastController
  ) { }

  username: any = new FormControl('', Validators.required)
  password: any = new FormControl('', Validators.required)

  ngOnInit() { }

  ionViewWillEnter() { }

  async notif(msg, color) {
    const toast = await this.toastController.create({
      message: msg,
      color: color,
      duration: 500
    });
    await toast.present();
  }

  login() {
    this.http.post('http://localhost:8080/api/login', 'username=' + this.username.value + '&password=' + this.password.value, { headers: { 'Content-Type': 'application/x-www-form-urlencoded' } })
      .subscribe((res: any) => {
        if (res.token) {
          localStorage.setItem('token', res.token)
          this.notif(res.msg, 'success')
          this.router.navigate(['tabs/'])
        } else {
          this.notif(res.msg, 'danger')
        }
      }),
      (error: any) => {
        this.notif('Kesalahan jaringan', 'danger')
      }
  }

}
