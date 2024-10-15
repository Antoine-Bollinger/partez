export default class copyCode {
    #preContainers: NodeListOf<HTMLPreElement> | null = document.querySelectorAll("pre")

    constructor() {
        this._setCodeCopyLink()
    }

    private _setCodeCopyLink(): void {
        if (!this.#preContainers) return;
        this.#preContainers.forEach(pre => {
            const copyLink = document.createElement("a")
            copyLink.innerHTML = "📋"
            copyLink.href = "#"
            copyLink.title = "Copy"
            const initialize = (): void => {
                copyLink.innerHTML = "📋"
                pre.classList.remove("snapshot")
            }
            copyLink.addEventListener("click", (e: MouseEvent) => {
                e.preventDefault()
                initialize()
                const codeElement = pre.querySelector("code")
                if (codeElement) {
                    navigator.clipboard.writeText(codeElement.innerText)
                    pre.classList.add("snapshot")
                    copyLink.innerHTML = "✅"
                    setTimeout(() => {
                        initialize()
                    }, 400)
                }
            })
            pre.append(copyLink)
        })
    }
}