import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../auth.service';
import { UserService } from '../user.service';

@Component({
  selector: 'app-logout',
  templateUrl: './logout.component.html',
  styleUrls: ['./logout.component.css']
})
export class LogoutComponent implements OnInit {

  constructor(private user:UserService, private router:Router,private Auth:AuthService) { }

  ngOnInit(): void {
    this.user.logout().subscribe(user => {
      console.log(user)
      this.Auth.setIsEtudiantLogedIn(false,'');
      this.Auth.setIsAdministratifLogedIn(false,'');
      this.Auth.setIsEnseignantLogedIn(false);
      localStorage.removeItem('EtudiantLogged');
      localStorage.removeItem('EnseignantLogged');
      localStorage.removeItem('AdministratifLogged');
      this.router.navigate([''])
    });
  }

}
