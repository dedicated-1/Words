
export function fetchHeaders(csrf){

    let headers = {
        method: "POST",  
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf 
        }
    }

    return headers 
}