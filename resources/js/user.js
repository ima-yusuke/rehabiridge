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
            }
        });
    }, observerOptions);

    document.querySelectorAll('.story').forEach(story => {
        observer.observe(story);
    });
});
