'use strict';

{
  
  //--宣言--
  let word;//現在の単語
  let loc;//文字の位置
  let score;//正解数
  let miss;//不正解数
  const timeLimit = 3 * 1000;
  let startTime;
  let isPlaying = false;
  let quiz =[];

  // 要素のid取得
  const target = document.getElementById('target');
  const scoreLabel = document.getElementById('score');
  const missLabel = document.getElementById('miss');
  const timerLabel = document.getElementById('timer');

  //--関数--

  //単語表示の変更
  //loc個の_(アンダーバー)+loc番目からの文字列を表示
  function updateTarget() {
    let placeholder = '';
    for (let i = 0; i < loc; i++) {
      placeholder += '_';
    }
    target.textContent = placeholder + word.substring(loc);
    
  }

  function colorupdateTarget() {
    let placeholder = '';
    for (let i = 0; i < loc; i++) {
      placeholder += '_';
    }
    target.innerHTML =placeholder+"<span style='color:red;'>" +word.substring(loc,loc+1)+"</span>" + word.substring(loc+1);

  }

  

  //タイマー
  function updateTimer() {
    const timeLeft = startTime + timeLimit - Date.now();
    timerLabel.textContent = (timeLeft / 1000).toFixed(2);

    //再帰 10msごと これでカウントダウンしているように見える
    const timeoutId = setTimeout(() => {
      updateTimer();
    }, 10);

    //タイマー終了
    if (timeLeft < 0) {
      isPlaying = false;

      clearTimeout(timeoutId);
      timerLabel.textContent = '0.00';
      setTimeout(() => {
        showResult();
      }, 100);
      
      target.textContent = 'click to replay';
    }
  }

  function showResult() {
    const accuracy = score + miss === 0 ? 0 : score / (score + miss) * 100;
    //score送信
    let scoreobject={"score":score};
    $.post(
      "../lib/Model/UpdateScore.php",
      scoreobject,
      function(data){
       comment.textContent=data; //結果をアラートで表示
       console.log(data);
       }
    );
    
    // alert(`${score} letters, ${miss} misses, ${accuracy.toFixed(2)}% accuracy!`);

  }

  //最初クリックしたときの処理
  window.addEventListener('click', () => {
    //すでにクリックされていたら行わない
    if (isPlaying === true) {
      return;
    }


    isPlaying = true;

    loc = 0;
    score = 0;
    miss = 0;
    scoreLabel.textContent = score;
    missLabel.textContent = miss;
    
    //クイズの取得
    $.get(
      "../lib/Model/Getquiz.php",
      {"isplaying" : "true"},
      "json"
    ).done(function(data){
     
      quiz=data.slice();
      console.log(quiz);
      console.log(data);

      word = quiz[Math.floor(Math.random() * quiz.length)];  

      target.textContent = word;
      startTime = Date.now();
      updateTimer();

   }).fail(function(XMLHttpRequest, textStatus, errorThrown){
       alert(errorThrown);
   })


  });

  //文字を打った時の処理
  window.addEventListener('keydown', e => {
    //最初にクリックされていなかったら行わない
    if (isPlaying !== true) {
      return;
    }

    if (e.key === word[loc]) {
      loc++;
      if (loc === word.length) {
        word = quiz[Math.floor(Math.random() * quiz.length)];
        loc = 0;
      }
      updateTarget();
      score++;
      scoreLabel.textContent = score;
    } else {
      colorupdateTarget();
      miss++;
      missLabel.textContent = miss;
    }
  });
}

function a(){

}
