(window.webpackJsonp=window.webpackJsonp||[]).push([[7],{QnAh:function(e,t,n){"use strict";n.r(t),n.d(t,"maskConfig",function(){return I}),n.d(t,"AcessoModule",function(){return q});var a=n("ofXK"),r=n("tyNb"),o=n("fXoL"),i=n("sksZ"),c=n("bv9b");function s(e,t){1&e&&(o.Ub(0,"div",1),o.Pb(1,"mat-progress-bar",2),o.Tb())}let m=(()=>{class e{constructor(e){this.loaderService=e}ngOnInit(){}}return e.\u0275fac=function(t){return new(t||e)(o.Ob(i.e))},e.\u0275cmp=o.Ib({type:e,selectors:[["app-acesso"]],decls:3,vars:3,consts:[["class","loader-container",4,"ngIf"],[1,"loader-container"],["mode","indeterminate"]],template:function(e,t){1&e&&(o.Bc(0,s,2,0,"div",0),o.hc(1,"async"),o.Pb(2,"router-outlet")),2&e&&o.mc("ngIf",o.ic(1,1,t.loaderService.isLoading))},directives:[a.l,r.g,c.a],pipes:[a.b],styles:[".loader-container[_ngcontent-%COMP%]{position:fixed;width:100%;z-index:99}"]}),e})();var l=n("3Pt+");class d{static passwordMatch(e){return t=>e&&t.value===e.value?null:{passwordMismatch:!0}}}var p=n("XiUz"),b=n("Wp6s"),u=n("kmnG"),g=n("qFsG"),f=n("tmjD"),h=n("bTqV");function x(e,t){1&e&&(o.Ub(0,"mat-error"),o.Cc(1,"Informe sua matr\xedcula"),o.Tb())}function C(e,t){1&e&&(o.Ub(0,"mat-error"),o.Cc(1,"Informe um seu CPF"),o.Tb())}function O(e,t){1&e&&(o.Ub(0,"mat-error"),o.Cc(1,"Informe sua data de nascimento"),o.Tb())}function P(e,t){1&e&&(o.Ub(0,"mat-error"),o.Cc(1,"Informe um e-mail v\xe1lido"),o.Tb())}function M(e,t){1&e&&(o.Ub(0,"mat-error"),o.Cc(1,"Informe uma senha"),o.Tb())}function v(e,t){if(1&e&&(o.Ub(0,"mat-error"),o.Cc(1),o.Tb()),2&e){const e=o.gc();o.Db(1),o.Ec("A senha dever pelo menos ",e.tamanhoMinimoSenha," caracteres")}}function w(e,t){1&e&&(o.Ub(0,"mat-error"),o.Cc(1,"Favor confirmar a senha"),o.Tb())}function _(e,t){1&e&&(o.Ub(0,"mat-error"),o.Cc(1,"As senhas n\xe3o conferem"),o.Tb())}let y=(()=>{class e{constructor(t,n,a,r,o){this.authService=t,this.dialogoService=n,this.fb=a,this.notificacao=r,this.router=o,this.gerarSenhaForm=this.fb.group({matricula:["",l.t.required],cpf:["",l.t.required],nascimento:["",l.t.required],email:["",[l.t.required,l.t.email]],senha:["",[l.t.required,l.t.minLength(e.TAMANHO_MINIMO_SENHA)]],confirmacao:["",l.t.required]})}get pathLogin(){return e.PATH_LOGIN}get tamanhoMinimoSenha(){return e.TAMANHO_MINIMO_SENHA}get matricula(){return this.gerarSenhaForm.get("matricula")}get cpf(){return this.gerarSenhaForm.get("cpf")}get nascimento(){return this.gerarSenhaForm.get("nascimento")}get email(){return this.gerarSenhaForm.get("email")}get senha(){return this.gerarSenhaForm.get("senha")}get confirmacao(){return this.gerarSenhaForm.get("confirmacao")}ngOnInit(){var e;null===(e=this.confirmacao)||void 0===e||e.setValidators([l.t.required,d.passwordMatch(this.senha)]),this.gerarSenhaForm.updateValueAndValidity()}onSubmit(){var t,n,a,r,o,i,c,s,m,l;const d={matricula:null===(n=null===(t=this.gerarSenhaForm)||void 0===t?void 0:t.get("matricula"))||void 0===n?void 0:n.value,cpf:null===(r=null===(a=this.gerarSenhaForm)||void 0===a?void 0:a.get("cpf"))||void 0===r?void 0:r.value,nascimento:null===(i=null===(o=this.gerarSenhaForm)||void 0===o?void 0:o.get("nascimento"))||void 0===i?void 0:i.value,email:null===(s=null===(c=this.gerarSenhaForm)||void 0===c?void 0:c.get("email"))||void 0===s?void 0:s.value,senha:null===(l=null===(m=this.gerarSenhaForm)||void 0===m?void 0:m.get("senha"))||void 0===l?void 0:l.value};this.authService.gerarSenha(d).subscribe({next:()=>{this.dialogoService.informarSucesso("Gerar senha","Quase pronto! Agora voc\xea precisa validar seu acesso atrav\xe9s de um link que foi enviado para o e-mail informado.").subscribe(()=>{this.router.navigate([e.PATH_LOGIN])})},error:e=>{this.notificacao.erro(e)}})}}return e.PATH_LOGIN="/acesso/login",e.TAMANHO_MINIMO_SENHA=6,e.\u0275fac=function(t){return new(t||e)(o.Ob(i.a),o.Ob(i.d),o.Ob(l.e),o.Ob(i.f),o.Ob(r.c))},e.\u0275cmp=o.Ib({type:e,selectors:[["app-gerar-senha"]],decls:34,vars:11,consts:[["fxLayout","row","fxLayoutAlign","center center",1,"main-wrapper"],[1,"box"],[1,"example-form",3,"formGroup","ngSubmit"],[1,"example-full-width"],["matInput","","placeholder","Matr\xedcula","formControlName","matricula","mask","0999999999","required",""],[4,"ngIf"],["matInput","","placeholder","CPF","formControlName","cpf","mask","099.099.099-09","required",""],["matInput","","type","date","placeholder","Data de nascimento","formControlName","nascimento","required",""],["matInput","","type","email","placeholder","E-mail","formControlName","email","required",""],["matInput","","type","password","placeholder","Senha desejada","formControlName","senha","required",""],["matInput","","type","password","placeholder","Confirma\xe7\xe3o da senha","formControlName","confirmacao","required",""],["mat-stroked-button","","color","accent",1,"btn-block",3,"disabled"],[3,"routerLink"]],template:function(e,t){1&e&&(o.Ub(0,"div",0),o.Ub(1,"mat-card",1),o.Ub(2,"mat-card-header"),o.Ub(3,"mat-card-title"),o.Cc(4,"Gerar senha"),o.Tb(),o.Tb(),o.Ub(5,"form",2),o.cc("ngSubmit",function(){return t.onSubmit()}),o.Ub(6,"mat-card-content"),o.Ub(7,"mat-form-field",3),o.Pb(8,"input",4),o.Bc(9,x,2,0,"mat-error",5),o.Tb(),o.Ub(10,"mat-form-field",3),o.Pb(11,"input",6),o.Bc(12,C,2,0,"mat-error",5),o.Tb(),o.Ub(13,"mat-form-field",3),o.Pb(14,"input",7),o.Bc(15,O,2,0,"mat-error",5),o.Tb(),o.Ub(16,"mat-form-field",3),o.Pb(17,"input",8),o.Bc(18,P,2,0,"mat-error",5),o.Tb(),o.Ub(19,"mat-form-field",3),o.Pb(20,"input",9),o.Bc(21,M,2,0,"mat-error",5),o.Bc(22,v,2,1,"mat-error",5),o.Tb(),o.Ub(23,"mat-form-field",3),o.Pb(24,"input",10),o.Bc(25,w,2,0,"mat-error",5),o.Bc(26,_,2,0,"mat-error",5),o.Tb(),o.Tb(),o.Ub(27,"button",11),o.Cc(28,"Enviar"),o.Tb(),o.Tb(),o.Ub(29,"mat-card-footer"),o.Pb(30,"br"),o.Ub(31,"p"),o.Ub(32,"a",12),o.Cc(33,"Acessar recadastramento"),o.Tb(),o.Tb(),o.Tb(),o.Tb(),o.Tb()),2&e&&(o.Db(5),o.mc("formGroup",t.gerarSenhaForm),o.Db(4),o.mc("ngIf",null==t.matricula?null:t.matricula.hasError("required")),o.Db(3),o.mc("ngIf",null==t.cpf?null:t.cpf.hasError("required")),o.Db(3),o.mc("ngIf",null==t.nascimento?null:t.nascimento.hasError("required")),o.Db(3),o.mc("ngIf",(null==t.email?null:t.email.hasError("required"))||(null==t.email?null:t.email.hasError("email"))),o.Db(3),o.mc("ngIf",null==t.senha?null:t.senha.hasError("required")),o.Db(1),o.mc("ngIf",null==t.senha?null:t.senha.hasError("minlength")),o.Db(3),o.mc("ngIf",null==t.confirmacao?null:t.confirmacao.hasError("required")),o.Db(1),o.mc("ngIf",(null==t.confirmacao?null:t.confirmacao.invalid)&&!(null!=t.confirmacao&&t.confirmacao.hasError("required"))),o.Db(1),o.mc("disabled",!t.gerarSenhaForm.valid),o.Db(5),o.mc("routerLink",t.pathLogin))},directives:[p.c,p.b,b.a,b.d,b.f,l.u,l.o,l.g,b.b,u.c,g.b,l.c,f.a,l.n,l.f,l.s,a.l,h.a,b.c,r.e,u.b],styles:[".loader-container[_ngcontent-%COMP%]{position:fixed;width:100%;z-index:99}",'body[_ngcontent-%COMP%], html[_ngcontent-%COMP%]{height:100%;margin:0;padding:0}body[_ngcontent-%COMP%]{min-height:100vh;background-color:#e5e5e5;font-family:Roboto,sans-serif}.app-header[_ngcontent-%COMP%]{justify-content:space-between;position:fixed;top:0;left:0;right:0;z-index:2;box-shadow:0 3px 5px -1px rgba(0,0,0,.2),0 6px 10px 0 rgba(0,0,0,.14),0 1px 18px 0 rgba(0,0,0,.12)}.main-wrapper[_ngcontent-%COMP%]{height:100%;background-color:#e5e5e5}.positronx[_ngcontent-%COMP%]{text-decoration:none;color:#fff}.box[_ngcontent-%COMP%]{position:relative;top:0;opacity:1;float:left;padding:60px 50px 40px;width:100%;background:#fff;border-radius:10px;transform:scale(1);-webkit-transform:scale(1);-ms-transform:scale(1);z-index:5;max-width:330px}.box.back[_ngcontent-%COMP%]{top:-20px;opacity:.8}.box.back[_ngcontent-%COMP%], .box[_ngcontent-%COMP%]:before{transform:scale(.95);-webkit-transform:scale(.95);-ms-transform:scale(.95);z-index:-1}.box[_ngcontent-%COMP%]:before{content:"";width:100%;height:30px;border-radius:10px;position:absolute;top:-10px;background:hsla(0,0%,100%,.6);left:0}.main-wrapper[_ngcontent-%COMP%]   .example-form[_ngcontent-%COMP%]{min-width:100%;max-width:300px;width:100%}.main-wrapper[_ngcontent-%COMP%]   .btn-block[_ngcontent-%COMP%], .main-wrapper[_ngcontent-%COMP%]   .example-full-width[_ngcontent-%COMP%]{width:100%;margin-bottom:10px}.main-wrapper[_ngcontent-%COMP%]   .mat-card-footer[_ngcontent-%COMP%]{text-align:center}.main-wrapper[_ngcontent-%COMP%]   mat-card-header[_ngcontent-%COMP%]{text-align:center;width:100%;display:block;font-weight:700;margin-bottom:10px}.main-wrapper[_ngcontent-%COMP%]   mat-card-header[_ngcontent-%COMP%]   mat-card-title[_ngcontent-%COMP%]{font-size:30px;margin:0;white-space:nowrap}.main-wrapper[_ngcontent-%COMP%]   .mat-card[_ngcontent-%COMP%]{padding:45px 70px 55px}.main-wrapper[_ngcontent-%COMP%]   .mat-stroked-button[_ngcontent-%COMP%]{border:1px solid;line-height:54px;background:#fff7fa}.main-wrapper[_ngcontent-%COMP%]   .mat-form-field-appearance-legacy[_ngcontent-%COMP%]   .mat-form-field-infix[_ngcontent-%COMP%]{padding:.8375em 0}']}),e})();const T=[{path:"",redirectTo:"/",pathMatch:"full"},{path:"",component:m,children:[{path:"login",component:(()=>{class e{constructor(e,t,n,a){this.authService=e,this.fb=t,this.notificacao=n,this.route=a,this.loginForm=this.fb.group({login:["",l.t.required],senha:["",l.t.required]})}ngOnInit(){this.authService.isAuthenticated()&&this.authService.redirecionarUsuarioAutenticado()}onSubmit(){var e,t;this.authService.login(null===(e=this.loginForm.get("login"))||void 0===e?void 0:e.value,null===(t=this.loginForm.get("senha"))||void 0===t?void 0:t.value).subscribe({next:()=>{this.authService.redirecionarUsuarioAutenticado("/"!==this.route.snapshot.queryParams.returnUrl?this.route.snapshot.queryParams.returnUrl:void 0)},error:e=>{this.notificacao.erro(e)}})}}return e.\u0275fac=function(t){return new(t||e)(o.Ob(i.a),o.Ob(l.e),o.Ob(i.f),o.Ob(r.a))},e.\u0275cmp=o.Ib({type:e,selectors:[["app-login"]],decls:18,vars:2,consts:[["fxLayout","row","fxLayout.xs","column","fxFlexFill","","fxLayoutAlign","center center",1,"main-wrapper"],[1,"box"],[1,"example-form",3,"formGroup","ngSubmit"],[1,"example-full-width"],["matInput","","placeholder","Matr\xedcula","formControlName","login","required",""],["matInput","","type","password","placeholder","Senha","formControlName","senha","required",""],["mat-stroked-button","","type","submit","color","accent",1,"btn-block",3,"disabled"],["routerLink","/acesso/gerar-senha"]],template:function(e,t){1&e&&(o.Ub(0,"div",0),o.Ub(1,"mat-card",1),o.Ub(2,"mat-card-header"),o.Ub(3,"mat-card-title"),o.Cc(4,"Login"),o.Tb(),o.Tb(),o.Ub(5,"form",2),o.cc("ngSubmit",function(){return t.onSubmit()}),o.Ub(6,"mat-card-content"),o.Ub(7,"mat-form-field",3),o.Pb(8,"input",4),o.Tb(),o.Ub(9,"mat-form-field",3),o.Pb(10,"input",5),o.Tb(),o.Tb(),o.Ub(11,"button",6),o.Cc(12,"Enviar"),o.Tb(),o.Tb(),o.Ub(13,"mat-card-footer"),o.Pb(14,"br"),o.Ub(15,"p"),o.Ub(16,"a",7),o.Cc(17,"Gerar senha de acesso"),o.Tb(),o.Tb(),o.Tb(),o.Tb(),o.Tb()),2&e&&(o.Db(5),o.mc("formGroup",t.loginForm),o.Db(6),o.mc("disabled",!t.loginForm.valid))},directives:[p.c,p.e,p.b,b.a,b.d,b.f,l.u,l.o,l.g,b.b,u.c,g.b,l.c,l.n,l.f,l.s,h.a,b.c,r.e],styles:['body[_ngcontent-%COMP%], html[_ngcontent-%COMP%]{height:100%;margin:0;padding:0}body[_ngcontent-%COMP%]{min-height:100vh;background-color:#e5e5e5;font-family:Roboto,sans-serif}.app-header[_ngcontent-%COMP%]{justify-content:space-between;position:fixed;top:0;left:0;right:0;z-index:2;box-shadow:0 3px 5px -1px rgba(0,0,0,.2),0 6px 10px 0 rgba(0,0,0,.14),0 1px 18px 0 rgba(0,0,0,.12)}.main-wrapper[_ngcontent-%COMP%]{height:100%;background-color:#e5e5e5}.positronx[_ngcontent-%COMP%]{text-decoration:none;color:#fff}.box[_ngcontent-%COMP%]{position:relative;top:0;opacity:1;float:left;padding:60px 50px 40px;width:100%;background:#fff;border-radius:10px;transform:scale(1);-webkit-transform:scale(1);-ms-transform:scale(1);z-index:5;max-width:330px}.box.back[_ngcontent-%COMP%]{top:-20px;opacity:.8}.box.back[_ngcontent-%COMP%], .box[_ngcontent-%COMP%]:before{transform:scale(.95);-webkit-transform:scale(.95);-ms-transform:scale(.95);z-index:-1}.box[_ngcontent-%COMP%]:before{content:"";width:100%;height:30px;border-radius:10px;position:absolute;top:-10px;background:hsla(0,0%,100%,.6);left:0}.main-wrapper[_ngcontent-%COMP%]   .example-form[_ngcontent-%COMP%]{min-width:100%;max-width:300px;width:100%}.main-wrapper[_ngcontent-%COMP%]   .btn-block[_ngcontent-%COMP%], .main-wrapper[_ngcontent-%COMP%]   .example-full-width[_ngcontent-%COMP%]{width:100%}.main-wrapper[_ngcontent-%COMP%]   .mat-card-footer[_ngcontent-%COMP%]{text-align:center}.main-wrapper[_ngcontent-%COMP%]   mat-card-header[_ngcontent-%COMP%]{text-align:center;width:100%;display:block;font-weight:700;margin-bottom:10px}.main-wrapper[_ngcontent-%COMP%]   mat-card-header[_ngcontent-%COMP%]   mat-card-title[_ngcontent-%COMP%]{font-size:30px;margin:0;white-space:nowrap}.main-wrapper[_ngcontent-%COMP%]   .mat-card[_ngcontent-%COMP%]{padding:45px 70px 55px}.main-wrapper[_ngcontent-%COMP%]   .mat-stroked-button[_ngcontent-%COMP%]{border:1px solid;line-height:54px;background:#fff7fa}.main-wrapper[_ngcontent-%COMP%]   .mat-form-field-appearance-legacy[_ngcontent-%COMP%]   .mat-form-field-infix[_ngcontent-%COMP%]{padding:.8375em 0}']}),e})()},{path:"gerar-senha",component:y},{path:"validacao/:validacao",component:(()=>{class e{constructor(e,t,n,a,r){this.authService=e,this.dialogoService=t,this.notificacaoService=n,this.route=a,this.router=r,this.validacao=""}ngAfterViewInit(){this.authService.validarAcesso(this.validacao).subscribe({next:()=>{this.dialogoService.informarSucesso("Valida\xe7\xe3o","Seu acesso foi validado").subscribe(()=>{this.router.navigate(["/"])})},error:e=>{this.dialogoService.informarErro("Valida\xe7\xe3o","N\xe3o foi poss\xedvel validar seu acesso. Gere um nova senha ou entre em contato.").subscribe(()=>{}),this.notificacaoService.erro(e)}})}ngOnInit(){this.validacao=this.route.snapshot.paramMap.get("validacao")||""}}return e.\u0275fac=function(t){return new(t||e)(o.Ob(i.a),o.Ob(i.d),o.Ob(i.f),o.Ob(r.a),o.Ob(r.c))},e.\u0275cmp=o.Ib({type:e,selectors:[["app-validacao"]],decls:14,vars:0,consts:[["fxLayout","row","fxLayout.xs","column","fxFlexFill","","fxLayoutAlign","center center",1,"main-wrapper"],[1,"box"],["routerLink","/acesso/login"],["routerLink","/acesso/gerar-senha"]],template:function(e,t){1&e&&(o.Ub(0,"div",0),o.Ub(1,"mat-card",1),o.Ub(2,"mat-card-header"),o.Ub(3,"mat-card-title"),o.Cc(4,"Valida\xe7\xe3o"),o.Tb(),o.Tb(),o.Pb(5,"mat-card-content"),o.Ub(6,"mat-card-footer"),o.Pb(7,"br"),o.Ub(8,"p"),o.Ub(9,"a",2),o.Cc(10,"Acessar recadastramento"),o.Tb(),o.Tb(),o.Ub(11,"p"),o.Ub(12,"a",3),o.Cc(13,"Gerar senha de acesso"),o.Tb(),o.Tb(),o.Tb(),o.Tb(),o.Tb())},directives:[p.c,p.e,p.b,b.a,b.d,b.f,b.b,b.c,r.e],styles:['body[_ngcontent-%COMP%], html[_ngcontent-%COMP%]{height:100%;margin:0;padding:0}body[_ngcontent-%COMP%]{min-height:100vh;background-color:#e5e5e5;font-family:Roboto,sans-serif}.app-header[_ngcontent-%COMP%]{justify-content:space-between;position:fixed;top:0;left:0;right:0;z-index:2;box-shadow:0 3px 5px -1px rgba(0,0,0,.2),0 6px 10px 0 rgba(0,0,0,.14),0 1px 18px 0 rgba(0,0,0,.12)}.main-wrapper[_ngcontent-%COMP%]{height:100%;background-color:#e5e5e5}.positronx[_ngcontent-%COMP%]{text-decoration:none;color:#fff}.box[_ngcontent-%COMP%]{position:relative;top:0;opacity:1;float:left;padding:60px 50px 40px;width:100%;background:#fff;border-radius:10px;transform:scale(1);-webkit-transform:scale(1);-ms-transform:scale(1);z-index:5;max-width:330px}.box.back[_ngcontent-%COMP%]{top:-20px;opacity:.8}.box.back[_ngcontent-%COMP%], .box[_ngcontent-%COMP%]:before{transform:scale(.95);-webkit-transform:scale(.95);-ms-transform:scale(.95);z-index:-1}.box[_ngcontent-%COMP%]:before{content:"";width:100%;height:30px;border-radius:10px;position:absolute;top:-10px;background:hsla(0,0%,100%,.6);left:0}.main-wrapper[_ngcontent-%COMP%]   .example-form[_ngcontent-%COMP%]{min-width:100%;max-width:300px;width:100%}.main-wrapper[_ngcontent-%COMP%]   .btn-block[_ngcontent-%COMP%], .main-wrapper[_ngcontent-%COMP%]   .example-full-width[_ngcontent-%COMP%]{width:100%}.main-wrapper[_ngcontent-%COMP%]   .mat-card-footer[_ngcontent-%COMP%]{text-align:center}.main-wrapper[_ngcontent-%COMP%]   mat-card-header[_ngcontent-%COMP%]{text-align:center;width:100%;display:block;font-weight:700;margin-bottom:10px}.main-wrapper[_ngcontent-%COMP%]   mat-card-header[_ngcontent-%COMP%]   mat-card-title[_ngcontent-%COMP%]{font-size:30px;margin:0;white-space:nowrap}.main-wrapper[_ngcontent-%COMP%]   .mat-card[_ngcontent-%COMP%]{padding:45px 70px 55px}.main-wrapper[_ngcontent-%COMP%]   .mat-stroked-button[_ngcontent-%COMP%]{border:1px solid;line-height:54px;background:#fff7fa}.main-wrapper[_ngcontent-%COMP%]   .mat-form-field-appearance-legacy[_ngcontent-%COMP%]   .mat-form-field-infix[_ngcontent-%COMP%]{padding:.8375em 0}']}),e})()}]},{path:"**",redirectTo:"/"}];let k=(()=>{class e{}return e.\u0275mod=o.Mb({type:e}),e.\u0275inj=o.Lb({factory:function(t){return new(t||e)},imports:[[r.f.forChild(T)],r.f]}),e})();var S=n("PI13"),U=n("YUcS");const I={validation:!0};let q=(()=>{class e{}return e.\u0275mod=o.Mb({type:e}),e.\u0275inj=o.Lb({factory:function(t){return new(t||e)},imports:[[a.c,k,S.a,U.a,l.i,f.b.forRoot(),l.r]]}),e})()}}]);