const signInBtn = document.querySelector("#sign-in-btn")
const signUpBtn = document.querySelector("#sign-up-btn")

const containerLoginSignUp = document.querySelector(".container")

signUpBtn.addEventListener("click", () => {
    containerLoginSignUp.classList.add("sign-up-mode")
})

signInBtn.addEventListener("click", () => {
    containerLoginSignUp.classList.remove("sign-up-mode")
})