/* 
Biblioteca criada por https://github.com/paulohenriquesn
link github: https://github.com/paulohenriquesn/pix-utils-js/tree/main
licensa: nenhuma
*/

class Validator {
    isEmail(email) {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
        return emailRegex.test(email)
    }

    isUUID(uuid) {
        const uuidRegex = /^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-4[0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/
        return uuidRegex.test(uuid)
    }

    isPhoneNumber(phoneNumber) {
        const phoneNumberRegex = /^(\+\d{2}\s*)?(\(\d{2}\))?\s*(\d{4,5}-?\d{4})$/
        return phoneNumberRegex.test(phoneNumber)
    }

    isCPF(cpf) {
        const cpfRegex = /^(\d{3}\.\d{3}\.\d{3}-\d{2}|\d{11})$/;
        return cpfRegex.test(cpf)
    }

    isCNPJ(cnpj) {
        const cnpjRegex = /^(\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}|\d{14})$/;
        return cnpjRegex.test(cnpj)
    }

    isQRCode(pixKeyCopyPaste) {
        const qrCodeRegex = /^(000201|01|2636)/
        return qrCodeRegex.test(pixKeyCopyPaste)
    }
}

const validator = new Validator();

const validationPixMap = {
    email: validator.isEmail,
    random: validator.isUUID,
    phone: validator.isPhoneNumber,
    cnpj: validator.isCNPJ,
    cpf: validator.isCPF,
    qrcode: validator.isQRCode
};


const validate = (input) => {
    const { pix } = input
    let { type } = input

    if(!pix) {
        throw new Error("chave pix invalida.")
    }

    if(!type) {
        try {
            let identifiedPix = identify({ pix })
            type = identifiedPix.type
        }catch {
            return false
        }
    }

    return validationPixMap[type](pix)
}

const identify = (input) => {
    const { pix } = input

    if(!pix) {
        throw new Error("chave pix invalida.")
    }

    for (const type in validationPixMap) {
        if (validationPixMap[type](pix)) {
            return { type, pix };
        }
    }

    throw new Error("chave pix invalida.")
}

const normalize = (input) => {
    let { pix } = input

    if(!pix || !validate({ pix})) {
        throw new Error("chave pix invalida.")
    }

    const { type } = identify({ pix })

    if(type === 'cpf' || type === 'cnpj' || type === 'phone') {
        pix = pix.replace(/[^0-9]/g, '')
    }

    return { pix, type }
}