//Fecha y hora
function startTime(){
    today=new Date();
    var dia=new Array(7);
        dia[0]="Domingo";
        dia[1]="Lunes";
        dia[2]="Martes";
        dia[3]="Miercoles";
        dia[4]="Jueves";
        dia[5]="Viernes";
        dia[6]="Sabado";
    var mes=new Array(12);
        mes[0]="Enero";
        mes[1]="Febrero";
        mes[2]="Marzo";
        mes[3]="Abril";
        mes[4]="Mayo";
        mes[5]="Junio";
        mes[6]="Julio";
        mes[7]="Agosto";
        mes[8]="Septiembre";
        mes[9]="Octubre";
        mes[10]="Noviembre";
        mes[11]="Diciembre";
    H=today.getDay();
    D=today.getDate();
    M=today.getMonth();
    A=today.getFullYear();
    h=today.getHours();
    m=today.getMinutes();
    s=today.getSeconds();
    m=checkTime(m);
    s=checkTime(s);
    document.getElementById('reloj').innerHTML=dia[H]+" "+D+" de "+mes[M]+" del "+A+", "+h+":"+m+":"+s+" ";
    t=setTimeout('startTime()',500);}
    function checkTime(i)
    {if (i<10) {i="0" + i;}return i;}
    window.onload=function(){startTime();}
