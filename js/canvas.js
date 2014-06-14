function test() {
  //描画コンテキストの取得
  var canvas = document.getElementById('sample');
  if (canvas.getContext) {
    var context = canvas.getContext('2d');
    //ここに具体的な描画内容を指定する
    //新しいパスを開始する
    context.beginPath();
    //(140,80)を中心点とする、半径50の円弧を、開始角度90度、終了角度180度で、半時計回りに作成する
    context.arc(140,80,50,45/180*Math.PI,135/180*Math.PI,true);
    //現在のパスを輪郭表示する
    context.stroke();
  }
}