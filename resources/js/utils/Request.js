import { article } from "./Mockup";

const post = (link) => {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve(article);
        }, 1000);
    })
}

export default { post };