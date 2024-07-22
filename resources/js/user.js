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
