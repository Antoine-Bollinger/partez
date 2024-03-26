export default class Login {
    #login
    #logout

    constructor() {
        this.#login = document.forms.login
        this.#logout = document.forms.logout
        this.init()
    }

    loginHandler() {
        this.#login?.addEventListener("submit", async e => {
            e.preventDefault()
            const login = await fetch(e.target.action, {
                method: "POST",
                body: new FormData(e.target)
            })
            const data = await login.json()
            localStorage.setItem("token", data.data.token)
            localStorage.setItem("id", data.data.id)
            location.reload()
        })
    }

    logoutHandler() {
        this.#logout?.addEventListener("submit", async e => {
            e.preventDefault()
            await fetch(e.target.action, {
                headers: {
                    "Authorization": localStorage.getItem("token"),
                    "X-Client-ID": localStorage.getItem("id")
                },
                method: "POST",
            })
            localStorage.removeItem("token")
            localStorage.removeItem("id")
            location.reload()
        })
    }

    async init() {
        this.loginHandler()
        this.logoutHandler()
    }
}