let basic = document.getElementsByClassName("alertmes");
let alert_box = document.getElementsByClassName("alert");
if(basic.length != 0)
{
   setTimeout(disapper,10000);
   function disapper()
   {
      let link = document.querySelector('.alertmes');
      link.setAttribute('hidden','.alertmes');
   }
}
if( alert_box != 0 )
{
   setTimeout(disapper_all,10000);
   function disapper_all()
   {
      let link = document.querySelector('.alert');
      link.setAttribute('hidden','.alert');
   }

}


