function guideText() {
  const content = document.getElementById("guide-content");
  return content ? content.innerText.trim() : document.body.innerText.trim();
}

async function copyText(text) {
  await navigator.clipboard.writeText(text);
}

document.getElementById("copy-guide")?.addEventListener("click", async () => {
  await copyText(guideText());
  alert("Návod byl zkopírován do schránky.");
});

document.querySelectorAll("[data-copy-code]").forEach((button) => {
  button.addEventListener("click", async () => {
    const box = button.closest(".border");
    const code = box?.querySelector("code")?.innerText ?? "";
    await copyText(code);
    const original = button.innerText;
    button.innerText = "Zkopírováno";
    setTimeout(() => {
      button.innerText = original;
    }, 1200);
  });
});

document.querySelectorAll('a[href^="#"]').forEach((link) => {
  link.addEventListener("click", (event) => {
    const target = document.querySelector(link.getAttribute("href"));
    if (!target) {
      return;
    }

    event.preventDefault();
    target.scrollIntoView({ behavior: "smooth", block: "start" });
    history.replaceState(null, "", link.getAttribute("href"));
  });
});
