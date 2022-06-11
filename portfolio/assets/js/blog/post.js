import('../../scss/app.scss');
import('../../scss/blog/post.scss');

const copyButtonLabel = "Copy";

let blocks = document.querySelectorAll("pre");

blocks.forEach((block) => {
    if (navigator.clipboard) {
        let button = document.createElement("button");
        button.innerText = copyButtonLabel;
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

    button.innerText = "copied";

    setTimeout(()=> {
        button.innerText = copyButtonLabel;
    },1000)
}