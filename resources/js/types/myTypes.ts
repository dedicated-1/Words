export interface WordSentencePivot {
    'sentence_id':number,
    'word_id':number,

    /**
     * this is the word, as it appears in the sentence
     */
    'tooltip':string,
    'clip':number,
}

export interface Word {
    id:number,

    word:string,
    searchterm:string,
    pronounciation:string,
    language:string,

    //definition
    hebrew:string,
    english:string,
    japanese:string,
    spanish:string,
    greek:string,
    german:string,

    pivot:WordSentencePivot, //sentence_word pivot table

    sentences: Sentence[],

    type:string,
    extra:string,
}

export interface Sentence {
    id:number,

    sentence:string,
    pronounciation:string,
    language:string,

    //definition
    hebrew:string,
    english:string,
    japanese:string,
    spanish:string,
    greek:string,
    german:string,
    
    words: Word[]

    type:string,
    extra:string,

    category: String,


}

export interface Category {
    id:number,
    name:string,
    sentences:Sentence[],
    order:number
}


export type SortableEl = {
    id: number 
    name: string
  }

export interface Panel {
    id:number,
    main:string,

    //definition
    hebrew:string,
    english:string,
    japanese:string,
    spanish:string,
    greek:string,
    german:string,
}

// export interface LanguageEnum {
//     // english  : string,
//     // japanese : string,
//     // hebrew   : string,
//     // greek    : string,
//     // german   : string,
//     // spanish  : string,
//     value:string,
// }
