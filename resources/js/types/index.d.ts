export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export interface Product{
    id: number,
    title: string,
    thumbnail: string,
    discountPercentage: number,
    price: number
}

export type Category = {
    id: number,
    name: string,
    color: string,
    image: string,
}


export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
