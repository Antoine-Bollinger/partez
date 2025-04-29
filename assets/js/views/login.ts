export default class Login {
    #login: HTMLFormElement | null
    #logout: HTMLFormElement | null

    constructor() {
        this.#login = document.forms.namedItem("login")
        this.#logout = document.forms.namedItem("logout")
        this.init()
    }

    private loginHandler(): void {
        this.#login?.addEventListener("submit", async (e: Event) => {
            e.preventDefault()
            const form = e.target as HTMLFormElement
            const login = await fetch(form.action, {
                method: "POST",
                body: new FormData(form)
            })
            const data = await login.json()
            localStorage.setItem("token", data.data.token)
            localStorage.setItem("id", data.data.id)
            location.reload()
        });
    }

    private logoutHandler(): void {
        this.#logout?.addEventListener("submit", async (e: Event) => {
            e.preventDefault()
            const form = e.target as HTMLFormElement
            const logout = await fetch(form.action, {
                headers: {
                    "Authorization": localStorage.getItem("token") || "",
                    "X-Client-ID": localStorage.getItem("id") || ""
                },
                method: "POST",
            })
            localStorage.removeItem("token")
            localStorage.removeItem("id")
            location.reload()
        });
    }

    private async init(): Promise<void> {
        this.loginHandler()
        this.logoutHandler()
    }
}
