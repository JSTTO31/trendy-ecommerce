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
    price: number,
    images: string[],
    rating: number,
    shippingInformation: string,
    minimumOrderQuantity: number,
    category: string,
    brand: string,
    warrantyInformation: string,
    returnPolicy: string,
    description: string
}

export interface OrderItem{
    id: number,
    user_id: number,
    product_id: number,
    order_id: number,
    quantity: number,
    price: number
    product: Product
}


export interface Order{
    id: number,
    user_id: number,
    price: number
    status: string
    updated_at: string,
    created_at:string
}

export type Category = {
    id: number,
    name: string,
    color: string,
    image: string,
}

export type Message = {
    title: string,
    sentence: string,
}


export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    flash: {
        success?: Message,
        information?: string,
    },
    isAuthenticated: boolean,
    cart_items_count: number,
    cart_items: {
        data: OrderItem[],
        "next_page_url": string | null,
        "path": string,
        "per_page": number,
        "prev_page_url": string | null,
        "to": number,
        "total": number
    }
};
