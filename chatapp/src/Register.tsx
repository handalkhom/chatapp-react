import React from "react";
import { LockOutlined, UserOutlined } from "@ant-design/icons";
import { Layout, theme, Button, Form, Input } from "antd";
import { Link } from "react-router-dom";

const { Header, Content, Footer } = Layout;

const onFinish = (values: any) => {
    console.log("Success:", values);
};

const tailFormItemLayout = {
    wrapperCol: {
        xs: {
            span: 24,
            offset: 0,
        },
        sm: {
            span: 16,
            offset: 8,
        },
    },
};

const Register: React.FC = () => {
    const {
        token: { colorBgContainer },
    } = theme.useToken();

    return (
        <Layout>
            <Header
                style={{
                    position: "sticky",
                    top: 0,
                    zIndex: 1,
                    width: "100%",
                    display: "flex",
                    alignItems: "center",
                    fontWeight: "bold",
                    color: "White",
                }}
            >
                REGISTER
            </Header>
            <Content
                className="site-layout"
                style={{
                    padding: "50px",
                }}
            >
                <Form
                    name="normal_login"
                    className="login-form"
                    initialValues={{ remember: true }}
                    onFinish={onFinish}
                    style={{
                        padding: "50px",
                        maxWidth: 800,
                        margin: "50px 30%",
                    }}
                >
                    <Form.Item
                        name="username"
                        rules={[
                            {
                                required: true,
                                message: "Please input your Username!",
                            },
                        ]}
                    >
                        <Input
                            prefix={
                                <UserOutlined className="site-form-item-icon" />
                            }
                            placeholder="Username"
                        />
                    </Form.Item>
                    <Form.Item
                        name="password"
                        rules={[
                            {
                                required: true,
                                message: "Please input your password!",
                            },
                        ]}
                        hasFeedback
                    >
                        <Input.Password
                            prefix={
                                <LockOutlined className="site-form-item-icon" />
                            }
                            type="password"
                            placeholder="Password"
                        />
                    </Form.Item>

                    <Form.Item
                        name="confirm"
                        dependencies={["password"]}
                        hasFeedback
                        rules={[
                            {
                                required: true,
                                message: "Please confirm your password!",
                            },
                            ({ getFieldValue }) => ({
                                validator(_, value) {
                                    if (
                                        !value ||
                                        getFieldValue("password") === value
                                    ) {
                                        return Promise.resolve();
                                    }
                                    return Promise.reject(
                                        new Error(
                                            "The new password that you entered do not match!"
                                        )
                                    );
                                },
                            }),
                        ]}
                    >
                        <Input.Password
                            prefix={
                                <LockOutlined className="site-form-item-icon" />
                            }
                            type="password"
                            placeholder="Confirm Password"
                        />
                    </Form.Item>

                    <Form.Item {...tailFormItemLayout}>
                        <Button type="primary" htmlType="submit">
                            Register
                        </Button>
                        Or <Link to="/">Login</Link>
                    </Form.Item>
                </Form>
            </Content>
            <Footer style={{ textAlign: "center" }}>
                Ant Design ©2023 Created by Ant UED
            </Footer>
        </Layout>
    );
};

export default Register;
