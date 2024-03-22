import { Form } from "laravel-precognition-alpine/dist/types";
import { RequestMethod } from "laravel-precognition/dist/types";

declare global {
  type PrecognitionForm<T> = (
    method: RequestMethod,
    url: string,
    inputs: T,
    config?: Record<string, unknown>
  ) => Form<Record<string, unknown>> & T;
}
