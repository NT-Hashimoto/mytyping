'use strict';

{
  
  //--宣言--
  //単語集
  const words = [
    'apple',
    'apricot',
    'strawberry',
    'persimmon',
    'Chinese quince',
    'kiwi fruit',
    'kumquat',
    'cherry',
    'pomegranate',
    'watermelon',
    'plum',
    'pear',
    'pineapple',
    'banana',
    'loquat',
    'grape',
    'mandarin',
    'melon',
    'peach',
    
  ];

  let word;//現在の単語
  let loc;//文字の位置
  let score;//正解数
  let miss;//不正解数
  const timeLimit = 2 * 1000;
  let startTime;
  let isPlaying = false;

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
    let scoreobject={"score":score};
    $.post(
      "index.php",
    scoreobject,
    function(data){
      alert(data); //結果をアラートで表示
      }
    );
    
    //alert(`${score} letters, ${miss} misses, ${accuracy.toFixed(2)}% accuracy!`);

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
    word = words[Math.floor(Math.random() * words.length)];

  

    target.textContent = word;
    startTime = Date.now();
    updateTimer();

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
        word = words[Math.floor(Math.random() * words.length)];
        loc = 0;
      }
      updateTarget();
      score++;
      scoreLabel.textContent = score;
    } else {
      miss++;
      missLabel.textContent = miss;
    }
  });

  //score送信
   //.sampleをクリックしてajax通信を行う
//    $('.sample_btn').click(function(){
//     $.ajax({
//         url: 'index.php',
//         type: 'POST',
//         /* json形式で受け取るためdataTypeを変更 */
//         dataType: 'json',
//         data : {
//             score : '100',
//         }
//     }).done(function(data){
//         /* 通信成功時 */
//         var html_response = '<ul>';
//         //json形式で受け取った配列を.each()で繰り返し、ul > liリストにする
//         $.each(data, function(key, value){
//             html_response += '<li>' + value + '</li>';
//         });
//         html_response += '</ul>';
//         $('.result').html(html_response); //取得したHTMLを.resultに反映
        
//     }).fail(function(data){
//         /* 通信失敗時 */
//         alert('通信失敗！');
                
//     });
// });
}
