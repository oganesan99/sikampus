declare global {
  type PrecognitionResponse<T> = {
    config: any;
    data: T;
    headers: any;
    request: XMLHttpRequest;
    status: number;
    statusText: string;
  };
}

export {};
