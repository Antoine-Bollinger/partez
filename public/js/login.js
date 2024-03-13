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
            localStorage.setItem("token", data.message)
            location.reload()
        })
    }

    logoutHandler() {
        this.#logout?.addEventListener("submit", async e => {
            e.preventDefault()
            await fetch(e.target.action, {
                headers: {
                    "Authorization": localStorage.getItem("token")
                },
                method: "POST",
            })
            localStorage.removeItem("token")
            location.reload()
        })
    }

    async init() {
        this.loginHandler()
        this.logoutHandler()
    }
}