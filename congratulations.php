<?php $id=$_GET['id'];
$name=mysqli_query($con,"select * from register where MatriId='$id'");
$fetnm=mysqli_fetch_array($name);?>
<div class="mvv-congrats-card">
  <div class="mvv-congrats-card-body">
    <div class="mvv-congrats-img-wrap">
      <img src="images/congratulations.png" alt="Congratulations">
    </div>
    <h5 class="mvv-congrats-name">Hello, <?php $explodename=explode(" ",$fetnm['Name']); echo $explodename[0];?></h5>
    <p class="mvv-congrats-msg">Congratulations! You're almost done.</p>
  </div>
</div>
<style>
.mvv-congrats-card {
  background: var(--gradient-card);
  border: 1px solid var(--border-warm);
  border-radius: 12px;
  padding: 28px 20px;
  box-shadow: var(--shadow-card);
  margin-bottom: 20px;
  text-align: center;
}
.mvv-congrats-card-body { padding: 0; }
.mvv-congrats-img-wrap {
  width: 80px;
  height: 80px;
  margin: 0 auto 14px;
  background: linear-gradient(135deg, #FFF0D0 0%, #FFE0A0 100%);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(200,130,50,0.2);
}
.mvv-congrats-img-wrap img {
  width: 48px;
  height: 48px;
  object-fit: contain;
}
.mvv-congrats-name {
  font-family: 'Playfair Display', serif;
  font-weight: 700;
  font-size: 1.15rem;
  color: var(--deep-maroon);
  margin: 0 0 6px;
}
.mvv-congrats-msg {
  font-size: 0.9rem;
  color: var(--saffron);
  font-weight: 500;
  margin: 0;
}
</style>
