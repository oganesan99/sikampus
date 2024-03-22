declare global {
  interface BeforeInstallPromptEvent extends Event {
    readonly platforms: Array<string>;
    readonly userChoice: Promise<{
      outcome: "accepted" | "dismissed";
      platform: Array<string>;
    }>;
    prompt(): Promise<{
      outcome: "accepted" | "dismissed";
      platform: Array<string>;
    }>;
  }
}

export {};
