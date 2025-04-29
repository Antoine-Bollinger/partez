import { capitals } from './letters.js'

const ESCAPE_CODE = "\u001b";

export class Console {
    text: string

    constructor(text: string) {
        this.setText(text)
    }

    setText(text: string) {
        this.text = text
    }

    static printLetters(
        {
            text = "",
            space = " ",
            glue = "\r\n"
        }: {
            text: string,
            space?: string,
            glue?: string
        }
    ): string {
        const tmp = text.split("").map(letter => {
            return capitals[letter.toLowerCase()] ?? (letter === " " ? capitals.empty : Array(10).fill(letter))
        })
        const render = Array(10).fill("").map((_, i) =>
            tmp.map(letter =>
                letter[i].replaceAll(" ", space)
            ).join("")
        ).join(glue)
        return render
    }
}