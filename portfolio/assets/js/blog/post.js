import('../../scss/blog/post.scss');

const copyButtonLabel = "Copy";
let blocks = document.querySelectorAll("pre");

blocks.forEach((block) => {
    if (navigator.clipboard) {
        let button = document.createElement("i");
        button.classList.add('fa-solid');
        button.classList.add('fa-clone');
        button.addEventListener("click", copyCode);
        block.appendChild(button);
    }
});
async function copyCode(event) {
    const button = event.target;
    const pre = button.parentElement;
    let code = pre.querySelector("code");
    let text = code.innerText;
    await navigator.clipboard.writeText(text);

    button.classList.remove('fa-clone');
    button.classList.add('fa-check');
    button.classList.add('copied');

    setTimeout(()=> {
        button.classList.remove('fa-check');
        button.classList.remove('copied');
        button.classList.add('fa-clone');
    },1000)
}