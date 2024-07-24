const HAMBURGER_ICON = document.getElementById('hamburger_icon');
const CLOSE_ICON = document.getElementById('close_icon');

// 投稿表示アニメーション
document.addEventListener("DOMContentLoaded", function() {
    const observerOptions = {
        threshold: 0.1 // 10% 以上見えたらアニメーション開始
    };

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
                observer.unobserve(entry.target); // アニメーション後に監視を停止する

                setTimeout(() => {
                    entry.target.classList.remove('fade-in');
                    entry.target.style.transform = ''; // 一度アニメーションが終わった要素を元の位置に戻す
                    entry.target.style.opacity = '1'; // 一度アニメーションが終わった要素を元の透明度に戻す
                },2000);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.story').forEach(story => {
        observer.observe(story);
    });
});

let side_menu = document.getElementsByClassName("side_menu_off")[0];
let main = document.getElementsByTagName("body")[0];

//サイドメニュー表示
HAMBURGER_ICON.addEventListener('click', function() {

    HAMBURGER_ICON.classList.add("hidden")
    CLOSE_ICON.classList.remove("hidden")

    // サイドメニュー表示
    side_menu.classList.remove("side_menu_off")
    side_menu.classList.add("side_menu_show")

    // mainをスクロール不可に
    main.classList.add("scroll_none")
})

// メニューのいずれかもしくは✗クリック時に画面グレー&サイドメニュー非表示
let side_li = document.getElementsByClassName("side_li");
for(let i= 0; i<side_li.length;i++){
    side_li[i].addEventListener("click",function (e){

        side_menu.classList.remove("side_menu_show")
        side_menu.classList.add("side_menu_off")

        HAMBURGER_ICON.classList.remove("hidden")
        CLOSE_ICON.classList.add("hidden")

        main.classList.remove("scroll_none")
    })
}

// サイドメニューの外をクリックしたらサイドメニュー閉じる
document.addEventListener("click",function (e){
    if((!e.target.closest('div.side_wrapper'))&& e.target!==HAMBURGER_ICON) {

        side_menu.classList.remove("side_menu_show")
        side_menu.classList.add("side_menu_off")

        HAMBURGER_ICON.classList.remove("hidden")
        CLOSE_ICON.classList.add("hidden")

        main.classList.remove("scroll_none")
    }
})
