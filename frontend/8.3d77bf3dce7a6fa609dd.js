(window.webpackJsonp=window.webpackJsonp||[]).push([[8],{jotI:function(a,t,i){"use strict";i.r(t),i.d(t,"CampanhaModule",function(){return oa});var e=i("ofXK"),r=i("YUcS"),c=i("FKr1"),o=i("3Pt+"),n=i("tyNb"),s=i("3S9H"),m=i("w4NO"),b=i("fXoL"),l=i("sksZ"),u=i("bTqV"),d=i("NFeN"),f=i("Wp6s"),h=i("XiUz"),p=i("kmnG"),v=i("qFsG"),g=i("d3UM"),C=i("iadO");function S(a,t){1&a&&(b.Ub(0,"mat-error"),b.Cc(1,"Informe a descri\xe7\xe3o da campanha"),b.Tb())}function D(a,t){if(1&a&&(b.Ub(0,"mat-option",23),b.Cc(1),b.Tb()),2&a){const a=t.$implicit;b.mc("value",a.chave),b.Db(1),b.Ec(" ",a.valor," ")}}function U(a,t){1&a&&(b.Ub(0,"mat-error"),b.Cc(1,"Selecione algum m\xeas"),b.Tb())}function T(a,t){1&a&&(b.Ub(0,"mat-error"),b.Cc(1,"Data inicial inv\xe1lida"),b.Tb())}function w(a,t){1&a&&(b.Ub(0,"mat-error"),b.Cc(1,"Informe a data inicial"),b.Tb())}function x(a,t){1&a&&(b.Ub(0,"mat-error"),b.Cc(1,"Data final inv\xe1lida"),b.Tb())}function y(a,t){1&a&&(b.Ub(0,"mat-error"),b.Cc(1,"Informe a data final"),b.Tb())}function I(a,t){if(1&a&&(b.Ub(0,"mat-option",23),b.Cc(1),b.Tb()),2&a){const a=t.$implicit;b.mc("value",a.chave),b.Db(1),b.Ec(" ",a.valor," ")}}const O=function(){return["/campanhas"]};function k(a,t){if(1&a){const a=b.Vb();b.Ub(0,"div",1),b.Ub(1,"h2"),b.Ub(2,"button",2),b.Ub(3,"mat-icon"),b.Cc(4,"chevron_left"),b.Tb(),b.Cc(5," Voltar "),b.Tb(),b.Cc(6),b.Tb(),b.Ub(7,"mat-card"),b.Ub(8,"mat-card-content"),b.Ub(9,"form",3),b.Ub(10,"div",4),b.Ub(11,"div",5),b.Ub(12,"mat-form-field",6),b.Pb(13,"input",7),b.Bc(14,S,2,0,"mat-error",8),b.Tb(),b.Tb(),b.Tb(),b.Ub(15,"div",4),b.Ub(16,"div",5),b.Ub(17,"mat-form-field",6),b.Ub(18,"mat-label"),b.Cc(19,"M\xeas de anivers\xe1rio"),b.Tb(),b.Ub(20,"mat-select",9),b.Bc(21,D,2,2,"mat-option",10),b.Tb(),b.Bc(22,U,2,0,"mat-error",8),b.Tb(),b.Tb(),b.Tb(),b.Ub(23,"div",4),b.Ub(24,"div",11),b.Ub(25,"mat-form-field",12),b.Ub(26,"mat-label"),b.Cc(27,"Per\xedodo"),b.Tb(),b.Ub(28,"mat-date-range-input",13),b.Pb(29,"input",14),b.Pb(30,"input",15),b.Tb(),b.Pb(31,"mat-datepicker-toggle",16),b.Pb(32,"mat-date-range-picker",null,17),b.Bc(34,T,2,0,"mat-error",8),b.Bc(35,w,2,0,"mat-error",8),b.Bc(36,x,2,0,"mat-error",8),b.Bc(37,y,2,0,"mat-error",8),b.Tb(),b.Tb(),b.Ub(38,"div",18),b.Ub(39,"mat-form-field",6),b.Ub(40,"mat-label"),b.Cc(41,"Ativa"),b.Tb(),b.Ub(42,"mat-select",19),b.Ub(43,"mat-option",20),b.Cc(44,"Selecione"),b.Tb(),b.Bc(45,I,2,2,"mat-option",10),b.Tb(),b.Tb(),b.Tb(),b.Tb(),b.Ub(46,"div",21),b.Ub(47,"button",22),b.cc("click",function(){return b.uc(a),b.gc().onSubmit()}),b.Cc(48,"Enviar"),b.Tb(),b.Tb(),b.Tb(),b.Tb(),b.Tb(),b.Tb()}if(2&a){const a=t.ngIf,i=b.sc(33),e=b.gc();b.Db(2),b.mc("routerLink",b.oc(14,O)),b.Db(4),b.Ec(" ",e.titulo," "),b.Db(3),b.mc("formGroup",e.formulario),b.Db(5),b.mc("ngIf",null==e.f.descricao.errors?null:e.f.descricao.errors.required),b.Db(7),b.mc("ngForOf",a.meses),b.Db(1),b.mc("ngIf",null==e.f.meses.errors?null:e.f.meses.errors.required),b.Db(6),b.mc("rangePicker",i),b.Db(3),b.mc("for",i),b.Db(3),b.mc("ngIf",null==e.f.inicio.errors?null:e.f.inicio.errors.matStartDateInvalid),b.Db(1),b.mc("ngIf",null==e.f.inicio.errors?null:e.f.inicio.errors.required),b.Db(1),b.mc("ngIf",null==e.f.fim.errors?null:e.f.fim.errors.matEndDateInvalid),b.Db(1),b.mc("ngIf",null==e.f.fim.errors?null:e.f.fim.errors.required),b.Db(8),b.mc("ngForOf",a.simnao),b.Db(2),b.mc("disabled",e.formulario.invalid)}}let B=(()=>{class a{constructor(a,t,i,e,r,c,o){this.campanhaService=a,this.configService=t,this.dialogoService=i,this.formBuilder=e,this.notificacaoService=r,this.route=c,this.router=o,this.config$=this.configService.getConfigList()}ngOnInit(){this.id=this.route.snapshot.params.id,this.titulo=void 0===this.id?"Nova campanha":"Campanha",void 0!==this.id?this.campanhaService.buscarPorId(this.id).subscribe(a=>{this.campanha=a,this.criarFormulario()}):this.criarFormulario()}onSubmit(){void 0===this.id?this.campanhaService.criar(this.formulario.value).subscribe({next:a=>{this.dialogoService.informarSucesso("Campanha",a.mensagem).subscribe(()=>{this.router.navigate(["campanhas/"+a.id])})},error:a=>{this.notificacaoService.erro(a)}}):this.campanhaService.alterarPorId(this.id,this.formulario.value).subscribe({next:a=>{this.dialogoService.informarSucesso("Campanha","Campanha atualizada").subscribe(()=>{this.router.navigate(["campanhas/"+a.id])})},error:a=>{this.notificacaoService.erro(a)}})}get f(){return this.formulario.controls}criarFormulario(){this.formulario=this.formBuilder.group({descricao:[{value:void 0!==this.id?this.campanha.descricao:""},o.t.required],meses:[void 0!==this.id?this.campanha.meses.map(a=>a.mes):"",o.t.required],inicio:[void 0!==this.id?this.campanha.inicio:"",o.t.required],fim:[void 0!==this.id?this.campanha.fim:"",o.t.required],ativo:[void 0!==this.id?this.campanha.ativo:"S",o.t.required]})}}return a.\u0275fac=function(t){return new(t||a)(b.Ob(l.b),b.Ob(l.c),b.Ob(l.d),b.Ob(o.e),b.Ob(l.f),b.Ob(n.a),b.Ob(n.c))},a.\u0275cmp=b.Ib({type:a,selectors:[["app-campanha"]],decls:2,vars:3,consts:[["class","container",4,"ngIf"],[1,"container"],["mat-stroked-button","",3,"routerLink"],[3,"formGroup"],["fxLayout","row","fxLayout.sm","column","fxLayout.xs","column","fxLayoutGap","0.5%"],["fxFlex.gt-sm","100%"],[1,"full-width"],["matInput","","placeholder","Descri\xe7\xe3o","name","descricao","formControlName","descricao","required",""],[4,"ngIf"],["placeholder","M\xeas de anivers\xe1rio","multiple","","name","meses","formControlName","meses","required",""],[3,"value",4,"ngFor","ngForOf"],["fxFlex.gt-sm","75%"],["appearance","fill"],[3,"rangePicker"],["matStartDate","","formControlName","inicio","placeholder","In\xedcio","required",""],["matEndDate","","formControlName","fim","placeholder","Fim","required",""],["matSuffix","",3,"for"],["picker",""],["fxFlex.gt-sm","25%"],["placeholder","Ativa","name","ativo","formControlName","ativo","required",""],["disabled",""],["fxLayout","row wrap","fxLayoutGap","10px"],["mat-raised-button","","color","primary",3,"disabled","click"],[3,"value"]],template:function(a,t){1&a&&(b.Bc(0,k,49,15,"div",0),b.hc(1,"async")),2&a&&b.mc("ngIf",b.ic(1,1,t.config$))},directives:[e.l,u.a,n.d,d.a,f.a,f.b,o.u,o.o,o.g,h.c,h.d,h.a,p.c,v.b,o.c,o.n,o.f,o.s,p.g,g.a,e.k,C.a,C.f,C.e,C.d,p.h,C.b,c.m,p.b],pipes:[e.b],styles:[".container[_ngcontent-%COMP%]{margin:10px}.full-width[_ngcontent-%COMP%]{width:100%}"]}),a})();var P=i("M9IT"),j=i("Dh3D"),L=i("vkgz"),A=i("nYR2"),R=i("jtHE"),F=i("2Vo4");class q{constructor(a){this.campanhaService=a,this.minhasCampanhasSubject=new R.a,this.loadingSubject=new F.a(!1),this.total=0,this.loading$=this.loadingSubject.asObservable()}connect(a){return this.minhasCampanhasSubject.asObservable()}disconnect(a){this.minhasCampanhasSubject.complete(),this.loadingSubject.complete()}carregar(a,t,i,e){this.loadingSubject.next(!0),this.campanhaService.listar(a,t,i+1,e).pipe(Object(A.a)(()=>this.loadingSubject.next(!1))).subscribe(a=>{this.total=a.total,this.minhasCampanhasSubject.next(a.data),this.loadingSubject.next(!1)})}}var M=i("+0xr");function z(a,t){1&a&&(b.Ub(0,"th",19),b.Cc(1,"Data"),b.Tb())}function $(a,t){if(1&a&&(b.Ub(0,"td",20),b.Cc(1),b.hc(2,"date"),b.Tb()),2&a){const a=t.$implicit;b.Db(1),b.Dc(b.jc(2,1,a.createdAt,"shortDate"))}}function G(a,t){1&a&&(b.Ub(0,"th",19),b.Cc(1,"Descri\xe7\xe3o"),b.Tb())}function N(a,t){if(1&a&&(b.Ub(0,"td",20),b.Cc(1),b.Tb()),2&a){const a=t.$implicit;b.Db(1),b.Dc(a.descricao)}}function _(a,t){1&a&&(b.Ub(0,"th",21),b.Cc(1,"Meses"),b.Tb())}function E(a,t){if(1&a&&(b.Ub(0,"td",20),b.Cc(1),b.Tb()),2&a){const a=t.$implicit,i=b.gc();b.Db(1),b.Dc(i.visualizarMeses(a.meses))}}function V(a,t){1&a&&(b.Ub(0,"th",21),b.Cc(1,"Per\xedodo"),b.Tb())}function H(a,t){if(1&a&&(b.Ub(0,"td",20),b.Cc(1),b.hc(2,"date"),b.hc(3,"date"),b.Tb()),2&a){const a=t.$implicit;b.Db(1),b.Fc("",b.jc(2,2,a.inicio,"shortDate"),"-",b.jc(3,5,a.fim,"shortDate"),"")}}function X(a,t){1&a&&(b.Ub(0,"th",19),b.Cc(1,"Ativo"),b.Tb())}function J(a,t){if(1&a&&(b.Ub(0,"td",20),b.Cc(1),b.Tb()),2&a){const a=t.$implicit;b.Db(1),b.Dc(a.ativo)}}function K(a,t){1&a&&b.Pb(0,"th",21)}function Y(a,t){if(1&a){const a=b.Vb();b.Ub(0,"button",23),b.cc("click",function(){b.uc(a);const t=b.gc().$implicit;return b.gc().visualizarCampanha(t.id)}),b.Ub(1,"mat-icon"),b.Cc(2,"visibility"),b.Tb(),b.Tb()}}function Q(a,t){if(1&a&&(b.Ub(0,"td",20),b.Bc(1,Y,3,0,"button",22),b.Tb()),2&a){const a=t.$implicit;b.Db(1),b.mc("ngIf",a.id)}}function W(a,t){1&a&&b.Pb(0,"tr",24)}function Z(a,t){if(1&a){const a=b.Vb();b.Ub(0,"tr",25),b.cc("click",function(){b.uc(a);const i=t.$implicit;return b.gc().visualizarCampanha(i.id)}),b.Tb()}}const aa=function(){return["/campanhas/nova"]},ta=function(){return[10,25,50]},ia=[{path:"",component:(()=>{class a{constructor(a,t,i){this.configService=a,this.campanhaService=t,this.router=i,this.displayedColumns=["createdAt","descricao","meses","periodo","ativo","acoes"]}ngAfterViewInit(){this.sort.sortChange.subscribe(()=>{this.paginator.pageIndex=0,this.carregarResultados()}),this.paginator.page.pipe(Object(L.a)(()=>this.carregarResultados())).subscribe()}ngOnInit(){this.configService.getConfigList().subscribe(a=>this.config=a),this.dataSource=new q(this.campanhaService),this.dataSource.carregar(this.displayedColumns[0],"asc",0,10)}carregarResultados(){this.dataSource.carregar(this.sort.active,this.sort.direction,this.paginator.pageIndex,this.paginator.pageSize)}visualizarCampanha(a){this.router.navigate(["/campanhas/",a])}visualizarMeses(a){return a.map(a=>a.mes)}}return a.\u0275fac=function(t){return new(t||a)(b.Ob(l.c),b.Ob(l.b),b.Ob(n.c))},a.\u0275cmp=b.Ib({type:a,selectors:[["app-lista-campanha"]],viewQuery:function(a,t){if(1&a&&(b.Gc(P.a,1),b.Gc(j.a,1)),2&a){let a;b.rc(a=b.dc())&&(t.paginator=a.first),b.rc(a=b.dc())&&(t.sort=a.first)}},decls:33,vars:9,consts:[[1,"container"],["fxLayout","row","fxLayout.sm","column","fxLayout.xs","column","fxLayoutGap","0.5%"],["fxFlex.gt-sm","75%"],["fxFlex.gt-sm","25%",2,"text-align","right"],["mat-stroked-button","","color","primary",3,"routerLink"],[1,"mat-elevation-z8"],["mat-table","","matSort","","matSortActive","createdAt","matSortDirection","asc","matSortDisableClear","",1,"full-width-table",3,"dataSource"],["matColumnDef","createdAt"],["mat-header-cell","","mat-sort-header","",4,"matHeaderCellDef"],["mat-cell","",4,"matCellDef"],["matColumnDef","descricao"],["matColumnDef","meses"],["mat-header-cell","",4,"matHeaderCellDef"],["matColumnDef","periodo"],["matColumnDef","ativo"],["matColumnDef","acoes"],["mat-header-row","",4,"matHeaderRowDef"],["mat-row","",3,"click",4,"matRowDef","matRowDefColumns"],[3,"length","pageSize","pageSizeOptions"],["mat-header-cell","","mat-sort-header",""],["mat-cell",""],["mat-header-cell",""],["mat-icon-button","","color","primary","title","Avaliar recadastramento",3,"click",4,"ngIf"],["mat-icon-button","","color","primary","title","Avaliar recadastramento",3,"click"],["mat-header-row",""],["mat-row","",3,"click"]],template:function(a,t){1&a&&(b.Ub(0,"div",0),b.Ub(1,"div",1),b.Ub(2,"div",2),b.Ub(3,"h2"),b.Cc(4,"Campanhas"),b.Tb(),b.Tb(),b.Ub(5,"div",3),b.Ub(6,"button",4),b.Cc(7," Adicionar campanha "),b.Ub(8,"mat-icon"),b.Cc(9,"add_circle_outline"),b.Tb(),b.Tb(),b.Tb(),b.Tb(),b.Ub(10,"div",5),b.Ub(11,"table",6),b.Sb(12,7),b.Bc(13,z,2,0,"th",8),b.Bc(14,$,3,4,"td",9),b.Rb(),b.Sb(15,10),b.Bc(16,G,2,0,"th",8),b.Bc(17,N,2,1,"td",9),b.Rb(),b.Sb(18,11),b.Bc(19,_,2,0,"th",12),b.Bc(20,E,2,1,"td",9),b.Rb(),b.Sb(21,13),b.Bc(22,V,2,0,"th",12),b.Bc(23,H,4,8,"td",9),b.Rb(),b.Sb(24,14),b.Bc(25,X,2,0,"th",8),b.Bc(26,J,2,1,"td",9),b.Rb(),b.Sb(27,15),b.Bc(28,K,1,0,"th",12),b.Bc(29,Q,2,1,"td",9),b.Rb(),b.Bc(30,W,1,0,"tr",16),b.Bc(31,Z,1,0,"tr",17),b.Tb(),b.Pb(32,"mat-paginator",18),b.Tb(),b.Tb()),2&a&&(b.Db(6),b.mc("routerLink",b.oc(7,aa)),b.Db(5),b.mc("dataSource",t.dataSource),b.Db(19),b.mc("matHeaderRowDef",t.displayedColumns),b.Db(1),b.mc("matRowDefColumns",t.displayedColumns),b.Db(1),b.mc("length",t.dataSource.total)("pageSize",10)("pageSizeOptions",b.oc(8,ta)))},directives:[h.c,h.d,h.a,u.a,n.d,d.a,M.j,j.a,M.c,M.e,M.b,M.g,M.i,P.a,M.d,j.b,M.a,e.l,M.f,M.h],pipes:[e.e],styles:[".container[_ngcontent-%COMP%]{margin:10px}.full-width-table[_ngcontent-%COMP%]{width:100%}.mat-row[_ngcontent-%COMP%]:hover{background-color:#f0f8ff}"]}),a})(),canActivate:[m.a],runGuardsAndResolvers:"always",data:{roles:[s.a.validador]}},{path:"nova",component:B,canActivate:[m.a],runGuardsAndResolvers:"always",data:{roles:[s.a.validador]}},{path:":id",component:B,canActivate:[m.a],runGuardsAndResolvers:"always",data:{roles:[s.a.validador]}}];let ea=(()=>{class a{}return a.\u0275mod=b.Mb({type:a}),a.\u0275inj=b.Lb({factory:function(t){return new(t||a)},imports:[[n.f.forChild(ia)],n.f]}),a})();var ra=i("PI13"),ca=i("PCNd");let oa=(()=>{class a{}return a.\u0275mod=b.Mb({type:a}),a.\u0275inj=b.Lb({factory:function(t){return new(t||a)},imports:[[ra.a,e.c,ea,r.a,C.c,c.l,o.r,ca.a]]}),a})()}}]);