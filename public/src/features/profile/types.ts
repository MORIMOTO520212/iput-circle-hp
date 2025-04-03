import { z } from 'zod';

export const profileFormSchema = z.object({
  displayName: z.string({ required_error: '入力必須' }),
  lastName: z.string({ required_error: '入力必須' }),
  firstName: z.string({ required_error: '入力必須' }),
  password: z
    .string()
    .min(6, '6文字以上で入力してください')
    .max(12, '12文字以内で入力してください')
    .nullable(),
});

export type ProfileForm = z.infer<typeof profileFormSchema>;
